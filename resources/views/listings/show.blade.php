<x-app-layout>
    @section('title', $listing->title)

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('listings.index') }}" style="color: var(--accent);" class="text-sm mb-4 inline-block">&larr; Back to listings</a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div style="background-color: var(--bg-card); border-color: var(--border-color);" class="border rounded-2xl overflow-hidden">
                    <div class="h-80 overflow-hidden flex items-center justify-center" style="background-color: var(--bg-input);">
                        @if($listing->image)
                            <img src="{{ Storage::url($listing->image) }}" alt="{{ $listing->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        @endif
                    </div>
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-sm font-medium rounded-full mb-3 {{ $listing->type == 'offering_room' ? 'bg-green-900/50 text-green-400' : 'bg-blue-900/50 text-blue-400' }}">
                            {{ $listing->type == 'offering_room' ? 'Offering Room' : 'Looking for Room' }}
                        </span>
                        <h1 class="text-2xl font-bold text-white mb-2">{{ $listing->title }}</h1>
                        <p class="font-bold text-2xl mb-4" style="color: var(--accent);">{{ number_format($listing->price) }} &#8376;/month</p>
                        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                            <div class="rounded-lg p-3" style="background-color: var(--bg-input);"><span class="text-gray-400">City:</span> <span class="text-white">{{ $listing->city }}</span></div>
                            <div class="rounded-lg p-3" style="background-color: var(--bg-input);"><span class="text-gray-400">Address:</span> <span class="text-white">{{ $listing->address }}</span></div>
                            <div class="rounded-lg p-3" style="background-color: var(--bg-input);"><span class="text-gray-400">Rooms:</span> <span class="text-white">{{ $listing->rooms }}</span></div>
                            <div class="rounded-lg p-3" style="background-color: var(--bg-input);"><span class="text-gray-400">Roommates needed:</span> <span class="text-white">{{ $listing->roommates_needed }}</span></div>
                        </div>
                        <h2 class="text-lg font-semibold text-white mb-2">Description</h2>
                        <p class="text-gray-300 whitespace-pre-line">{{ $listing->description }}</p>
                    </div>
                </div>
            </div>

            <div>
                <div style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 sticky top-4">
                    <h3 class="text-white font-bold mb-4">Posted by</h3>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg" style="background-color: var(--accent); color: #000;">
                            {{ substr($listing->user->name, 0, 1) }}
                        </div>
                        <div>
                            <a href="{{ route('users.show', $listing->user) }}" class="text-white font-semibold hover:underline">{{ $listing->user->name }}</a>
                            @if($listing->user->university)
                                <p class="text-gray-400 text-sm">{{ $listing->user->university }}</p>
                            @endif
                        </div>
                    </div>

                    @auth
                        @if(auth()->id() !== $listing->user_id)
                            <form method="POST" action="{{ route('chats.store') }}" class="mb-3">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $listing->user_id }}">
                                <button type="submit" class="btn-accent w-full font-semibold py-3 rounded-xl transition">
                                    Send Message
                                </button>
                            </form>
                            <form method="POST" action="{{ route('favorites.store') }}">
                                @csrf
                                <input type="hidden" name="type" value="listing">
                                <input type="hidden" name="id" value="{{ $listing->id }}">
                                <button type="submit" class="w-full py-3 rounded-xl transition border font-semibold" style="background-color: var(--bg-input); border-color: var(--border-color); color: var(--accent);">
                                    &#10084; Save to Favorites
                                </button>
                            </form>
                        @else
                            <div class="flex gap-2">
                                <a href="{{ route('listings.edit', $listing) }}" style="background-color: var(--bg-input);" class="flex-1 hover:bg-gray-700 text-white text-center font-semibold py-3 rounded-xl transition">Edit</a>
                                <form method="POST" action="{{ route('listings.destroy', $listing) }}" class="flex-1" onsubmit="return confirm('Delete this listing?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl transition">Delete</button>
                                </form>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-accent block w-full font-semibold py-3 rounded-xl transition text-center">Log in to contact</a>
                    @endauth

                    <p class="text-gray-500 text-xs mt-4">Posted {{ $listing->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
