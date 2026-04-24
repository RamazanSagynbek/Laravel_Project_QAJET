<x-app-layout>
    @section('title', $user->name)

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="glass border rounded-2xl p-8 mb-10" style="border-color: var(--border-color);">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-full flex items-center justify-center text-3xl font-black" style="background-color: var(--accent); color: #000;">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $user->name }}</h1>
                    @if($user->university)
                        <p class="text-gray-400 mt-1">{{ $user->university }}</p>
                    @endif
                    @if($user->bio)
                        <p class="text-gray-500 mt-2 max-w-xl">{{ $user->bio }}</p>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mt-8">
                <div class="text-center p-4 rounded-xl" style="background-color: var(--bg-input);">
                    <p class="text-2xl font-bold" style="color: var(--accent);">{{ $user->listings_count }}</p>
                    <p class="text-gray-400 text-sm">Listings</p>
                </div>
                <div class="text-center p-4 rounded-xl" style="background-color: var(--bg-input);">
                    <p class="text-2xl font-bold" style="color: var(--accent);">{{ $user->products_count }}</p>
                    <p class="text-gray-400 text-sm">Products</p>
                </div>
                <div class="text-center p-4 rounded-xl" style="background-color: var(--bg-input);">
                    <p class="text-2xl font-bold" style="color: var(--accent);">{{ $user->services_count }}</p>
                    <p class="text-gray-400 text-sm">Services</p>
                </div>
            </div>
        </div>

        @if($listings->count())
            <h2 class="text-xl font-bold text-white mb-4">Active Listings</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
                @foreach($listings as $listing)
                    <a href="{{ route('listings.show', $listing) }}" class="card-glow border rounded-2xl overflow-hidden transition" style="background-color: var(--bg-card); border-color: var(--border-color);">
                        <div class="p-4">
                            <h3 class="text-white font-semibold truncate">{{ $listing->title }}</h3>
                            <p class="text-sm mt-1" style="color: var(--accent);">{{ number_format($listing->price) }} &#8376;</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        @if($products->count())
            <h2 class="text-xl font-bold text-white mb-4">Active Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="card-glow border rounded-2xl overflow-hidden transition" style="background-color: var(--bg-card); border-color: var(--border-color);">
                        <div class="p-4">
                            <h3 class="text-white font-semibold truncate">{{ $product->title }}</h3>
                            <p class="text-sm mt-1" style="color: var(--accent);">{{ number_format($product->price) }} &#8376;</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        @if($services->count())
            <h2 class="text-xl font-bold text-white mb-4">Active Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
                @foreach($services as $service)
                    <a href="{{ route('services.show', $service) }}" class="card-glow border rounded-2xl overflow-hidden transition" style="background-color: var(--bg-card); border-color: var(--border-color);">
                        <div class="p-4">
                            <h3 class="text-white font-semibold truncate">{{ $service->title }}</h3>
                            <p class="text-sm mt-1" style="color: var(--accent);">{{ number_format($service->price) }} &#8376;</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
