<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Chat $chat)
    {
        $this->authorize('view', $chat);

        $validated = $request->validate([
            'body' => 'required|string|max:5000',
        ]);

        $message = $chat->messages()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body'],
        ]);

        $chat->touch();

        return redirect()->route('chats.show', $chat);
    }
}
