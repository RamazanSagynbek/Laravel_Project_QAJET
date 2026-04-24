<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Notifications\NewMessageNotification;
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

        $message->load('user');
        $chat->users()
            ->where('users.id', '!=', auth()->id())
            ->get()
            ->each(fn ($user) => $user->notify(new NewMessageNotification($message)));

        return redirect()->route('chats.show', $chat);
    }
}
