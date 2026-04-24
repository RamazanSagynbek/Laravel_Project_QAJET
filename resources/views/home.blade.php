<x-app-layout>
    @section('title', 'Home')

    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <div class="absolute inset-0" style="background: radial-gradient(ellipse at top, rgba(205,255,0,0.06) 0%, transparent 50%), linear-gradient(135deg, #0d1a00 0%, #0a0a0a 50%, #0a0a0a 100%);"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-4">
                    <span style="color: var(--accent);">QA</span>JET
                </h1>
                <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl mx-auto">
                    Your ultimate student assistant. Find roommates, buy & sell items, hire services, and connect with peers.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('listings.index') }}" class="btn-accent px-8 py-3 rounded-xl text-lg">
                        Find Roommates
                    </a>
                    <a href="{{ route('products.index') }}" class="text-white font-semibold px-8 py-3 rounded-xl border transition text-lg hover:bg-white/5 hover:border-white/20" style="border-color: rgba(255,255,255,0.1);">
                        Browse Marketplace
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-10">
        <div class="glass rounded-2xl p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-3xl font-extrabold" style="color: var(--accent);">{{ $stats['listings_count'] }}</div>
                    <div class="text-gray-400 text-sm mt-1">Rooms Available</div>
                </div>
                <div>
                    <div class="text-3xl font-extrabold" style="color: var(--accent);">{{ $stats['products_count'] }}</div>
                    <div class="text-gray-400 text-sm mt-1">Products Listed</div>
                </div>
                <div>
                    <div class="text-3xl font-extrabold" style="color: var(--accent);">{{ $stats['services_count'] }}</div>
                    <div class="text-gray-400 text-sm mt-1">Services Offered</div>
                </div>
                <div>
                    <div class="text-3xl font-extrabold" style="color: var(--accent);">{{ $stats['users_count'] }}</div>
                    <div class="text-gray-400 text-sm mt-1">Students Joined</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold text-white mb-6">Explore</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('listings.index') }}" class="card-glow flex flex-col items-center justify-center p-6 rounded-2xl border transition group" style="background-color: var(--bg-card); border-color: var(--border-color);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3" style="background-color: rgba(205,255,0,0.1);">
                    <svg class="w-7 h-7" style="color: var(--accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <span class="text-white font-semibold text-sm">Roommates</span>
                <span class="text-gray-600 text-xs mt-1">Find shared housing</span>
            </a>
            <a href="{{ route('products.index') }}" class="card-glow flex flex-col items-center justify-center p-6 rounded-2xl border transition group" style="background-color: var(--bg-card); border-color: var(--border-color);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3" style="background-color: rgba(205,255,0,0.1);">
                    <svg class="w-7 h-7" style="color: var(--accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <span class="text-white font-semibold text-sm">Marketplace</span>
                <span class="text-gray-600 text-xs mt-1">Buy & sell items</span>
            </a>
            <a href="{{ route('services.index') }}" class="card-glow flex flex-col items-center justify-center p-6 rounded-2xl border transition group" style="background-color: var(--bg-card); border-color: var(--border-color);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3" style="background-color: rgba(205,255,0,0.1);">
                    <svg class="w-7 h-7" style="color: var(--accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-white font-semibold text-sm">Services</span>
                <span class="text-gray-600 text-xs mt-1">Hire student talent</span>
            </a>
            @auth
            <a href="{{ route('chats.index') }}"
            @else
            <a href="{{ route('login') }}"
            @endauth
             class="card-glow flex flex-col items-center justify-center p-6 rounded-2xl border transition group" style="background-color: var(--bg-card); border-color: var(--border-color);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3" style="background-color: rgba(205,255,0,0.1);">
                    <svg class="w-7 h-7" style="color: var(--accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <span class="text-white font-semibold text-sm">Community</span>
                <span class="text-gray-600 text-xs mt-1">University chats</span>
            </a>
        </div>
    </section>

    <!-- Tabs + Latest Listings -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center gap-3 mb-6 overflow-x-auto">
            <span class="btn-accent px-5 py-2 rounded-xl text-sm cursor-pointer">Recommendations</span>
            <a href="{{ route('listings.index') }}" class="px-5 py-2 rounded-xl text-sm font-medium text-gray-400 border transition hover:text-white hover:border-white/20" style="border-color: var(--border-color);">Roommates</a>
            <a href="{{ route('products.index') }}" class="px-5 py-2 rounded-xl text-sm font-medium text-gray-400 border transition hover:text-white hover:border-white/20" style="border-color: var(--border-color);">Products</a>
            <a href="{{ route('services.index') }}" class="px-5 py-2 rounded-xl text-sm font-medium text-gray-400 border transition hover:text-white hover:border-white/20" style="border-color: var(--border-color);">Services</a>
        </div>

        <!-- Mixed content grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($listings as $listing)
                <a href="{{ route('listings.show', $listing) }}" class="card-glow rounded-2xl overflow-hidden border transition group" style="background-color: var(--bg-card); border-color: var(--border-color);">
                    <div class="h-48 flex items-center justify-center overflow-hidden" style="background-color: var(--bg-input);">
                        @if($listing->image)
                            <img src="{{ Storage::url($listing->image) }}" alt="{{ $listing->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex gap-2 mb-2">
                            <span class="px-2 py-1 rounded-lg text-xs font-bold" style="background-color: var(--accent); color: #000;">Apartment</span>
                            <span class="px-2 py-1 rounded-lg text-xs font-medium text-gray-500 border" style="border-color: var(--border-color);">Monthly</span>
                        </div>
                        <h3 class="text-white font-semibold mb-1">{{ $listing->title }}</h3>
                        <div class="flex items-center gap-1 text-gray-500 text-sm mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $listing->city }}, {{ $listing->address }}
                        </div>
                        <p class="font-bold" style="color: var(--accent);">{{ number_format($listing->price) }} &#8376; <span class="text-gray-500 font-normal text-sm">/ month</span></p>
                    </div>
                </a>
            @endforeach

            @foreach($products as $product)
                <a href="{{ route('products.show', $product) }}" class="card-glow rounded-2xl overflow-hidden border transition group" style="background-color: var(--bg-card); border-color: var(--border-color);">
                    <div class="h-48 flex items-center justify-center overflow-hidden" style="background-color: var(--bg-input);">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex gap-2 mb-2">
                            <span class="px-2 py-1 rounded-lg text-xs font-bold" style="background-color: var(--accent); color: #000;">Product</span>
                            <span class="px-2 py-1 rounded-lg text-xs font-medium text-gray-500 border" style="border-color: var(--border-color);">{{ ucfirst(str_replace('_', ' ', $product->condition)) }}</span>
                        </div>
                        <h3 class="text-white font-semibold mb-1">{{ $product->title }}</h3>
                        <p class="font-bold" style="color: var(--accent);">{{ number_format($product->price) }} &#8376;</p>
                    </div>
                </a>
            @endforeach

            @foreach($services as $service)
                <a href="{{ route('services.show', $service) }}" class="card-glow rounded-2xl overflow-hidden border transition group" style="background-color: var(--bg-card); border-color: var(--border-color);">
                    <div class="h-48 flex items-center justify-center overflow-hidden" style="background-color: var(--bg-input);">
                        @if($service->image)
                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex gap-2 mb-2">
                            <span class="px-2 py-1 rounded-lg text-xs font-bold" style="background-color: var(--accent); color: #000;">Service</span>
                            <span class="px-2 py-1 rounded-lg text-xs font-medium text-gray-500 border" style="border-color: var(--border-color);">{{ ucfirst($service->price_type) }}</span>
                        </div>
                        <h3 class="text-white font-semibold mb-1">{{ $service->title }}</h3>
                        <p class="font-bold" style="color: var(--accent);">{{ number_format($service->price) }} &#8376; <span class="text-gray-500 font-normal text-sm">/ {{ $service->price_type }}</span></p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('listings.index') }}" class="inline-flex items-center gap-2 font-medium transition hover:opacity-80" style="color: var(--accent);">
                View all listings
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </section>
</x-app-layout>
