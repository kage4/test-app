<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('post.message', compact('users'));
    }

    public function show(User $user)
    {
        $messages = Message::with('sender', 'receiver')
            ->where(function($query) use ($user) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', $user->id);
            })
            ->orWhere(function($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', auth()->id());
            })
            ->get();

        return view('post.talk', compact('user', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'body' => $request->body,
        ]);

        return redirect()->route('messages.show', $request->receiver_id)->with('message', 'メッセージを送信しました！');
    }
}

