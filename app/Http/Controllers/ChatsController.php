<?php

namespace App\Http\Controllers;
use App\Events\MessageSent;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
   
    public function index()
    {
        $messages = Message::with('user')->get();
        return view('chat', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);
        $message->load('user');
        broadcast(new MessageSent($message))->toOthers();
    
        return redirect('/chat');
    }
}
