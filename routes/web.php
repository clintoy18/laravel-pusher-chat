<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\PrivateChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //user list
    Route::get('/users', [ChatsController::class, 'userList'])->name('chat.users');


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Public Chat
    Route::get('/chat', [ChatsController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatsController::class, 'store'])->name('chat.store');

    // Private Chat
   // Private chat routes - use PrivateChatController here
     Route::get('/private-chat/{user}', [PrivateChatController::class, 'show'])->name('private.chat');
    Route::post('/private-chat/{user}/send', [PrivateChatController::class, 'send'])->name('private.chat.send');
});

require __DIR__.'/auth.php';
