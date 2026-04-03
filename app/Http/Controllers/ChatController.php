<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // University group chats (public — anyone can see and join)
        $universityChats = Chat::where('type', 'group')
            ->whereNotNull('university')
            ->withCount('users')
            ->with('latestMessage.user')
            ->orderBy('name')
            ->get();

        // User's private chats
        $privateChats = $user->chats()
            ->where('type', 'private')
            ->with(['users', 'latestMessage.user'])
            ->latest('chats.updated_at')
            ->get();

        return view('chats.index', compact('universityChats', 'privateChats'));
    }

    public function show(Chat $chat)
    {
        // For university group chats, auto-join if not a member
        if ($chat->type === 'group' && $chat->university) {
            if (!$chat->users()->where('users.id', auth()->id())->exists()) {
                $chat->users()->attach(auth()->id());
            }
        } else {
            $this->authorize('view', $chat);
        }

        $chat->load('users', 'messages.user');

        $chat->users()->updateExistingPivot(auth()->id(), [
            'last_read_at' => now(),
        ]);

        return view('chats.show', compact('chat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $otherUser = User::findOrFail($validated['user_id']);

        $existingChat = Chat::where('type', 'private')
            ->whereHas('users', fn($q) => $q->where('users.id', auth()->id()))
            ->whereHas('users', fn($q) => $q->where('users.id', $otherUser->id))
            ->first();

        if ($existingChat) {
            return redirect()->route('chats.show', $existingChat);
        }

        $chat = Chat::create(['type' => 'private']);
        $chat->users()->attach([auth()->id(), $otherUser->id]);

        return redirect()->route('chats.show', $chat);
    }
}
