<x-app-layout>
    @section('title', 'Marketplace')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Marketplace</h1>
            @auth
                <a href="{{ route('products.create') }}" class="btn-accent font-semibold px-6 py-2 rounded-xl transition">+ Sell Item</a>
            @endauth
        </div>

        <form method="GET" action="{{ route('products.index') }}" style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                <select name="category" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <select name="condition" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">Any Condition</option>
                    <option value="new" {{ request('condition') == 'new' ? 'selected' : '' }}>New</option>
                    <option value="like_new" {{ request('condition') == 'like_new' ? 'selected' : '' }}>Like New</option>
                    <option value="used" {{ request('condition') == 'used' ? 'selected' : '' }}>Used</option>
                    <option value="poor" {{ request('condition') == 'poor' ? 'selected' : '' }}>Poor</option>
                </select>
                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min price" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max price" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                <button type="submit" class="btn-accent rounded-lg font-semibold transition">Filter</button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <a href="{{ route('products.show', $product) }}" style="background-color: var(--bg-card); border-color: var(--border-color);" class="card-glow border rounded-2xl overflow-hidden hover:border-yellow-400/50 transition group">
                    <div class="h-48 overflow-hidden flex items-center justify-center" style="background-color: var(--bg-input);">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-white font-semibold group-hover:text-yellow-400 transition mb-1">{{ $product->title }}</h3>
                        <p class="font-bold text-lg" style="color: var(--accent);">{{ number_format($product->price) }} &#8376;</p>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-xs px-2 py-1 rounded-full text-gray-400" style="background-color: var(--bg-input);">{{ ucfirst(str_replace('_', ' ', $product->condition)) }}</span>
                            <span class="text-gray-500 text-xs">{{ $product->user->name }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-400 text-lg">No products found.</p>
                    @auth
                        <a href="{{ route('products.create') }}" style="color: var(--accent);" class="mt-2 inline-block">Sell your first item &rarr;</a>
                    @endauth
                </div>
            @endforelse
        </div>

        <div class="mt-8">{{ $products->withQueryString()->links() }}</div>
    </div>
</x-app-layout>
