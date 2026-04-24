<x-app-layout>
    @section('title', $chat->type === 'group' ? $chat->name : 'Chat')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('chats.index') }}" style="color: var(--accent);" class="hover:opacity-80 text-sm mb-4 inline-block">&larr; Back to Community</a>

        <div style="background-color: var(--bg-card); border-color: var(--border-color);" class="border rounded-2xl overflow-hidden">
            <!-- Chat Header -->
            <div style="background-color: var(--bg-input);" class="px-6 py-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold" style="background-color: var(--accent); color: #000;">
                    @if($chat->type === 'group')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    @else
                        @php $otherUser = $chat->users->where('id', '!=', auth()->id())->first(); @endphp
                        {{ $otherUser ? substr($otherUser->name, 0, 1) : '?' }}
                    @endif
                </div>
                <div>
                    <h2 class="text-white font-bold">
                        @if($chat->type === 'group')
                            {{ $chat->name }}
                        @else
                            {{ $otherUser->name ?? 'Unknown' }}
                        @endif
                    </h2>
                    @if($chat->type === 'group')
                        <p class="text-gray-400 text-xs">{{ $chat->users->count() }} members</p>
                    @endif
                </div>
            </div>

            <!-- Messages -->
            <div class="h-96 overflow-y-auto p-6 space-y-4" id="messages">
                @foreach($chat->messages as $message)
                    <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs lg:max-w-md">
                            @if($message->user_id !== auth()->id())
                                <p class="text-xs text-gray-500 mb-1">{{ $message->user->name }}</p>
                            @endif
                            <div class="{{ $message->user_id === auth()->id() ? 'text-black' : 'text-gray-200' }} rounded-2xl px-4 py-2" style="{{ $message->user_id === auth()->id() ? 'background-color: var(--accent);' : 'background-color: var(--bg-input);' }}">
                                <p>{{ $message->body }}</p>
                            </div>
                            <p class="text-xs text-gray-600 mt-1 {{ $message->user_id === auth()->id() ? 'text-right' : '' }}">{{ $message->created_at->format('H:i') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div style="border-color: var(--border-color);" class="border-t p-4">
                <form method="POST" action="{{ route('messages.store', $chat) }}" class="flex gap-3">
                    @csrf
                    <input type="text" name="body" placeholder="Type a message..." style="background-color: var(--bg-input); border-color: var(--border-color);" class="flex-1 text-white rounded-xl focus:ring-yellow-400 focus:border-yellow-400" required autofocus>
                    <button type="submit" class="btn-accent font-semibold px-6 rounded-xl transition hover:opacity-80">Send</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const messagesContainer = document.getElementById('messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        const chatId = {{ $chat->id }};
        const currentUserId = {{ auth()->id() }};
        let lastMessageId = {{ $chat->messages->last()?->id ?? 0 }};

        function renderMessage(msg) {
            const alignClass = msg.is_me ? 'justify-end' : 'justify-start';
            const bubbleStyle = msg.is_me ? 'background-color: var(--accent);' : 'background-color: var(--bg-input);';
            const textClass = msg.is_me ? 'text-black' : 'text-gray-200';
            const timeAlign = msg.is_me ? 'text-right' : '';
            const userName = msg.is_me ? '' : `<p class="text-xs text-gray-500 mb-1">${msg.user_name}</p>`;

            return `
                <div class="flex ${alignClass}">
                    <div class="max-w-xs lg:max-w-md">
                        ${userName}
                        <div class="${textClass} rounded-2xl px-4 py-2" style="${bubbleStyle}">
                            <p>${msg.body}</p>
                        </div>
                        <p class="text-xs text-gray-600 mt-1 ${timeAlign}">${msg.created_at}</p>
                    </div>
                </div>
            `;
        }

        async function pollMessages() {
            try {
                const res = await fetch(`/community/${chatId}/messages`);
                if (!res.ok) return;
                const data = await res.json();

                const newMessages = data.messages.filter(m => m.id > lastMessageId);
                if (newMessages.length > 0) {
                    const wasAtBottom = messagesContainer.scrollTop + messagesContainer.clientHeight >= messagesContainer.scrollHeight - 50;
                    newMessages.forEach(msg => {
                        messagesContainer.insertAdjacentHTML('beforeend', renderMessage(msg));
                        if (msg.id > lastMessageId) lastMessageId = msg.id;
                    });
                    if (wasAtBottom) {
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    }
                }
            } catch (e) {
                console.error('Poll error', e);
            }
        }

        setInterval(pollMessages, 5000);
    </script>
</x-app-layout>
