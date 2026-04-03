<x-app-layout>
    @section('title', $product->title)

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('products.index') }}" style="color: var(--accent);" class="text-sm mb-4 inline-block">&larr; Back to marketplace</a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div style="background-color: var(--bg-card); border-color: var(--border-color);" class="border rounded-2xl overflow-hidden">
                    <div class="h-96 overflow-hidden flex items-center justify-center" style="background-color: var(--bg-input);">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="px-3 py-1 text-sm font-medium rounded-full text-gray-300" style="background-color: var(--bg-input);">{{ ucfirst(str_replace('_', ' ', $product->condition)) }}</span>
                            @if($product->category)
                                <span class="px-3 py-1 text-sm font-medium rounded-full" style="background-color: rgba(205,255,0,0.1); color: var(--accent);">{{ $product->category->name }}</span>
                            @endif
                        </div>
                        <h1 class="text-2xl font-bold text-white mb-2">{{ $product->title }}</h1>
                        <p class="font-bold text-3xl mb-6" style="color: var(--accent);">{{ number_format($product->price) }} &#8376;</p>
                        <h2 class="text-lg font-semibold text-white mb-2">Description</h2>
                        <p class="text-gray-300 whitespace-pre-line">{{ $product->description }}</p>
                    </div>
                </div>
            </div>

            <div>
                <div style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 sticky top-4">
                    <h3 class="text-white font-bold mb-4">Seller</h3>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg" style="background-color: var(--accent); color: #000;">
                            {{ substr($product->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-white font-semibold">{{ $product->user->name }}</p>
                            @if($product->user->university)
                                <p class="text-gray-400 text-sm">{{ $product->user->university }}</p>
                            @endif
                        </div>
                    </div>

                    @auth
                        @if(auth()->id() !== $product->user_id)
                            <form method="POST" action="{{ route('chats.store') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $product->user_id }}">
                                <button type="submit" class="btn-accent w-full font-semibold py-3 rounded-xl transition">Send Message</button>
                            </form>
                        @else
                            <div class="flex gap-2">
                                <a href="{{ route('products.edit', $product) }}" style="background-color: var(--bg-input);" class="flex-1 hover:bg-gray-700 text-white text-center font-semibold py-3 rounded-xl transition">Edit</a>
                                <form method="POST" action="{{ route('products.destroy', $product) }}" class="flex-1" onsubmit="return confirm('Delete this product?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl transition">Delete</button>
                                </form>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-accent block w-full font-semibold py-3 rounded-xl transition text-center">Log in to contact</a>
                    @endauth

                    <p class="text-gray-500 text-xs mt-4">Posted {{ $product->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
