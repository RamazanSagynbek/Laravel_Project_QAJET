<x-app-layout>
    @section('title', 'Community')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-white mb-2">Community</h1>
            <p class="text-gray-500">Join your university chat and connect with fellow students</p>
        </div>

        <!-- University Group Chats -->
        <div class="mb-12">
            <h2 class="text-xl font-bold text-white mb-5 flex items-center gap-2">
                <svg class="w-5 h-5" style="color: var(--accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                University Chats
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($universityChats as $chat)
                    <a href="{{ route('chats.show', $chat) }}" class="card-glow border rounded-2xl p-5 transition group" style="background-color: var(--bg-card); border-color: var(--border-color);">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-lg font-black flex-shrink-0" style="background-color: rgba(205,255,0,0.15); color: var(--accent);">
                                {{ substr($chat->name, 0, 2) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-white font-bold text-lg group-hover:text-yellow-400 transition truncate">{{ $chat->name }}</h3>
                                <p class="text-gray-600 text-xs truncate">{{ $chat->university }}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5 text-gray-500 text-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $chat->users_count }} {{ $chat->users_count == 1 ? 'member' : 'members' }}
                            </div>
                            <span class="text-xs font-medium px-3 py-1 rounded-lg" style="background-color: rgba(205,255,0,0.1); color: var(--accent);">Join</span>
                        </div>
                        @if($chat->latestMessage)
                            <div class="mt-3 pt-3" style="border-top: 1px solid var(--border-color);">
                                <p class="text-gray-500 text-xs truncate">{{ $chat->latestMessage->user->name }}: {{ $chat->latestMessage->body }}</p>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Private Messages -->
        <div>
            <h2 class="text-xl font-bold text-white mb-5 flex items-center gap-2">
                <svg class="w-5 h-5" style="color: var(--accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Direct Messages
            </h2>

            @if($privateChats->count() > 0)
                <div class="space-y-2">
                    @foreach($privateChats as $chat)
                        @php $otherUser = $chat->users->where('id', '!=', auth()->id())->first(); @endphp
                        <a href="{{ route('chats.show', $chat) }}" class="card-glow block border rounded-2xl p-4 transition" style="background-color: var(--bg-card); border-color: var(--border-color);">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0" style="background-color: var(--accent); color: #000;">
                                    {{ $otherUser ? substr($otherUser->name, 0, 1) : '?' }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-white font-semibold truncate">{{ $otherUser->name ?? 'Unknown' }}</h3>
                                        @if($chat->latestMessage)
                                            <span class="text-gray-600 text-xs flex-shrink-0">{{ $chat->latestMessage->created_at->diffForHumans(null, true) }}</span>
                                        @endif
                                    </div>
                                    @if($chat->latestMessage)
                                        <p class="text-gray-500 text-sm truncate">{{ $chat->latestMessage->body }}</p>
                                    @else
                                        <p class="text-gray-600 text-sm">No messages yet</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 border rounded-2xl" style="background-color: var(--bg-card); border-color: var(--border-color);">
                    <p class="text-gray-500">No direct messages yet.</p>
                    <p class="text-gray-600 text-sm mt-1">Start a conversation by messaging someone from a listing, product, or service.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
