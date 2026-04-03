<x-app-layout>
    @section('title', 'Roommates')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Roommates</h1>
            @auth
                <a href="{{ route('listings.create') }}" class="btn-accent font-semibold px-6 py-2 rounded-xl transition">+ New Listing</a>
            @endauth
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('listings.index') }}" style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                <select name="type" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">All Types</option>
                    <option value="offering_room" {{ request('type') == 'offering_room' ? 'selected' : '' }}>Offering Room</option>
                    <option value="looking_for_room" {{ request('type') == 'looking_for_room' ? 'selected' : '' }}>Looking for Room</option>
                </select>
                <input type="text" name="city" value="{{ request('city') }}" placeholder="City" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min price" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max price" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                <button type="submit" class="btn-accent rounded-lg font-semibold transition">Filter</button>
            </div>
        </form>

        <!-- Listings Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($listings as $listing)
                <a href="{{ route('listings.show', $listing) }}" style="background-color: var(--bg-card); border-color: var(--border-color);" class="card-glow border rounded-2xl overflow-hidden hover:border-yellow-400/50 transition group">
                    <div class="h-48 overflow-hidden flex items-center justify-center" style="background-color: var(--bg-input);">
                        @if($listing->image)
                            <img src="{{ Storage::url($listing->image) }}" alt="{{ $listing->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="inline-block px-2 py-1 text-xs font-medium rounded-full mb-2 {{ $listing->type == 'offering_room' ? 'bg-green-900/50 text-green-400' : 'bg-blue-900/50 text-blue-400' }}">
                            {{ $listing->type == 'offering_room' ? 'Offering Room' : 'Looking for Room' }}
                        </span>
                        <h3 class="text-white font-semibold group-hover:text-yellow-400 transition mb-1">{{ $listing->title }}</h3>
                        <p class="font-bold text-lg" style="color: var(--accent);">{{ number_format($listing->price) }} &#8376;/month</p>
                        <p class="text-gray-400 text-sm mt-1">{{ $listing->city }} &bull; {{ $listing->rooms }} rooms &bull; {{ $listing->roommates_needed }} needed</p>
                        <p class="text-gray-500 text-xs mt-2">by {{ $listing->user->name }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-400 text-lg">No listings found.</p>
                    @auth
                        <a href="{{ route('listings.create') }}" style="color: var(--accent);" class="mt-2 inline-block">Create the first listing &rarr;</a>
                    @endauth
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $listings->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
