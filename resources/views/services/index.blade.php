<x-app-layout>
    @section('title', 'Services')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Student Services</h1>
            @auth
                <a href="{{ route('services.create') }}" class="btn-accent font-semibold px-6 py-2 rounded-xl transition hover:opacity-80">+ Offer Service</a>
            @endauth
        </div>

        <form method="GET" action="{{ route('services.index') }}" style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search services..." style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                <select name="category" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <select name="price_type" style="background-color: var(--bg-input); border-color: var(--border-color);" class="text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">Any Price Type</option>
                    <option value="fixed" {{ request('price_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="hourly" {{ request('price_type') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                    <option value="negotiable" {{ request('price_type') == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                </select>
                <button type="submit" class="btn-accent rounded-lg font-semibold transition hover:opacity-80">Filter</button>
            </div>
        </form>

        <!-- Horizontal service cards -->
        <div class="space-y-4">
            @forelse($services as $service)
                <a href="{{ route('services.show', $service) }}" class="card-glow block border rounded-2xl transition group p-5" style="background-color: var(--bg-card); border-color: var(--border-color);">
                    <!-- Top: Icon + Title + Badges -->
                    <div class="flex items-start gap-4 mb-3">
                        <div class="w-12 h-12 rounded-xl flex-shrink-0 flex items-center justify-center" style="background-color: rgba(205,255,0,0.1);">
                            @if($service->image)
                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover rounded-xl">
                            @else
                                <svg class="w-6 h-6" style="color: var(--accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                @if($service->category)
                                    <span class="text-xs px-2 py-0.5 rounded-full font-medium" style="background-color: rgba(205,255,0,0.1); color: var(--accent);">{{ $service->category->name }}</span>
                                @endif
                                <span class="text-xs px-2 py-0.5 rounded-full font-medium border" style="border-color: var(--border-color); color: #666;">{{ ucfirst($service->price_type) }}</span>
                            </div>
                            <h3 class="text-white font-bold text-lg group-hover:text-yellow-400 transition truncate">{{ $service->title }}</h3>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-xl" style="color: var(--accent);">{{ number_format($service->price) }} &#8376;</p>
                            <p class="text-gray-600 text-xs">/ {{ $service->price_type == 'fixed' ? 'project' : ($service->price_type == 'hourly' ? 'hour' : 'negotiable') }}</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-500 text-sm mb-4 line-clamp-2 pl-16">{{ Str::limit($service->description, 180) }}</p>

                    <!-- Bottom: Author -->
                    <div class="flex items-center gap-3 pl-16 pt-3" style="border-top: 1px solid var(--border-color);">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold" style="background-color: var(--accent); color: #000;">
                            {{ substr($service->user->name, 0, 1) }}
                        </div>
                        <span class="text-gray-400 text-sm">{{ $service->user->name }}</span>
                        @if($service->user->university)
                            <span class="text-gray-600 text-xs">&bull; {{ $service->user->university }}</span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="text-center py-16">
                    <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background-color: rgba(205,255,0,0.1);">
                        <svg class="w-10 h-10" style="color: var(--accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-gray-400 text-lg mb-2">No services found.</p>
                    @auth
                        <a href="{{ route('services.create') }}" class="inline-flex items-center gap-2 font-medium transition hover:opacity-80" style="color: var(--accent);">
                            Offer a service
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endauth
                </div>
            @endforelse
        </div>

        <div class="mt-8">{{ $services->withQueryString()->links() }}</div>
    </div>
</x-app-layout>
