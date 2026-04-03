<x-app-layout>
    @section('title', $service->title)

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('services.index') }}" style="color: var(--accent);" class="hover:opacity-80 text-sm mb-4 inline-block">&larr; Back to services</a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div style="background-color: var(--bg-card); border-color: var(--border-color);" class="border rounded-2xl overflow-hidden">
                    <div class="h-80 overflow-hidden flex items-center justify-center" style="background-color: var(--bg-input);">
                        @if($service->image)
                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="px-3 py-1 text-sm font-medium rounded-full text-gray-300" style="background-color: var(--bg-input);">{{ ucfirst($service->price_type) }}</span>
                            @if($service->category)
                                <span class="px-3 py-1 text-sm font-medium rounded-full" style="background-color: rgba(205,255,0,0.1); color: var(--accent);">{{ $service->category->name }}</span>
                            @endif
                        </div>
                        <h1 class="text-2xl font-bold text-white mb-2">{{ $service->title }}</h1>
                        <p style="color: var(--accent);" class="font-bold text-3xl mb-6">{{ number_format($service->price) }} &#8376; <span class="text-lg text-gray-400 font-normal">/ {{ $service->price_type }}</span></p>
                        <h2 class="text-lg font-semibold text-white mb-2">Description</h2>
                        <p class="text-gray-300 whitespace-pre-line">{{ $service->description }}</p>
                    </div>
                </div>
            </div>

            <div>
                <div style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 sticky top-4">
                    <h3 class="text-white font-bold mb-4">Service Provider</h3>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg" style="background-color: var(--accent); color: #000;">
                            {{ substr($service->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-white font-semibold">{{ $service->user->name }}</p>
                            @if($service->user->university)
                                <p class="text-gray-400 text-sm">{{ $service->user->university }}</p>
                            @endif
                        </div>
                    </div>

                    @auth
                        @if(auth()->id() !== $service->user_id)
                            <form method="POST" action="{{ route('chats.store') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $service->user_id }}">
                                <button type="submit" class="btn-accent w-full font-semibold py-3 rounded-xl transition hover:opacity-80">Send Message</button>
                            </form>
                        @else
                            <div class="flex gap-2">
                                <a href="{{ route('services.edit', $service) }}" style="background-color: var(--bg-input);" class="flex-1 hover:opacity-80 text-white text-center font-semibold py-3 rounded-xl transition">Edit</a>
                                <form method="POST" action="{{ route('services.destroy', $service) }}" class="flex-1" onsubmit="return confirm('Delete this service?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl transition">Delete</button>
                                </form>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-accent block w-full font-semibold py-3 rounded-xl transition text-center hover:opacity-80">Log in to contact</a>
                    @endauth

                    <p class="text-gray-500 text-xs mt-4">Posted {{ $service->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
