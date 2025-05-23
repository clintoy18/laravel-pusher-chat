<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateChatController extends Controller
{
    public function show(User $user)
    {
        $authId = Auth::id();

        $privateMessages = Message::with('user')
            ->where(function ($query) use ($user, $authId) {
                $query->where('user_id', $authId)->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($user, $authId) {
                $query->where('user_id', $user->id)->where('receiver_id', $authId);
            })
            ->orderBy('created_at')
            ->get();

        return view('private-chat', [
            'recipient' => $user,
            'privateMessages' => $privateMessages
        ]);
    }


    public function send(Request $request, User $user)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $message = Message::create([
            'user_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
        ]);

        $message->load('user');

        broadcast(new PrivateMessageSent($message, $user))->toOthers();

     return response()->json(['message' => $message]);
    }
}
