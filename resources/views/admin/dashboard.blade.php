<x-app-layout>
    @section('title', 'Admin Dashboard')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: rgba(205,255,0,0.15);">
                <svg class="w-5 h-5" style="color: var(--accent);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-white">Admin Dashboard</h1>
                <p class="text-gray-500 text-sm">Manage and moderate QAJET platform</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="glass border rounded-2xl p-5" style="border-color: var(--border-color);">
                <p class="text-3xl font-extrabold" style="color: var(--accent);">{{ $stats['users'] }}</p>
                <p class="text-gray-400 text-sm mt-1">Total Users</p>
            </div>
            <div class="glass border rounded-2xl p-5" style="border-color: var(--border-color);">
                <p class="text-3xl font-extrabold" style="color: var(--accent);">{{ $stats['active_listings'] }}</p>
                <p class="text-gray-400 text-sm mt-1">Active Listings</p>
            </div>
            <div class="glass border rounded-2xl p-5" style="border-color: var(--border-color);">
                <p class="text-3xl font-extrabold" style="color: var(--accent);">{{ $stats['active_products'] }}</p>
                <p class="text-gray-400 text-sm mt-1">Active Products</p>
            </div>
            <div class="glass border rounded-2xl p-5" style="border-color: var(--border-color);">
                <p class="text-3xl font-extrabold" style="color: var(--accent);">{{ $stats['active_services'] }}</p>
                <p class="text-gray-400 text-sm mt-1">Active Services</p>
            </div>
        </div>

        <!-- Latest Users -->
        <div class="mb-10">
            <h2 class="text-xl font-bold text-white mb-4">Latest Users</h2>
            <div class="glass border rounded-2xl overflow-hidden" style="border-color: var(--border-color);">
                <table class="w-full">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">ID</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Name</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Email</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">University</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Role</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestUsers as $user)
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td class="text-gray-500 text-sm px-5 py-3">{{ $user->id }}</td>
                            <td class="text-white text-sm px-5 py-3 font-medium">{{ $user->name }}</td>
                            <td class="text-gray-400 text-sm px-5 py-3">{{ $user->email }}</td>
                            <td class="text-gray-400 text-sm px-5 py-3">{{ $user->university ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <span class="text-xs px-2 py-1 rounded-full font-medium {{ $user->role === 'admin' ? '' : '' }}" style="{{ $user->role === 'admin' ? 'background-color: rgba(205,255,0,0.15); color: var(--accent);' : 'background-color: var(--bg-input); color: #888;' }}">{{ $user->role }}</span>
                            </td>
                            <td class="text-gray-500 text-sm px-5 py-3">{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest Listings -->
        <div class="mb-10">
            <h2 class="text-xl font-bold text-white mb-4">Latest Listings</h2>
            <div class="glass border rounded-2xl overflow-hidden" style="border-color: var(--border-color);">
                <table class="w-full">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Title</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Author</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Price</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Status</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestListings as $listing)
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td class="text-white text-sm px-5 py-3 font-medium">
                                <a href="{{ route('listings.show', $listing) }}" class="hover:underline" style="color: var(--accent);">{{ Str::limit($listing->title, 40) }}</a>
                            </td>
                            <td class="text-gray-400 text-sm px-5 py-3">{{ $listing->user->name }}</td>
                            <td class="text-white text-sm px-5 py-3">{{ number_format($listing->price) }} &#8376;</td>
                            <td class="px-5 py-3"><span class="text-xs px-2 py-1 rounded-full" style="background-color: var(--bg-input); color: #888;">{{ $listing->status }}</span></td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('admin.listings.delete', $listing) }}" onsubmit="return confirm('Delete this listing?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400 text-xs hover:text-red-300 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest Products -->
        <div class="mb-10">
            <h2 class="text-xl font-bold text-white mb-4">Latest Products</h2>
            <div class="glass border rounded-2xl overflow-hidden" style="border-color: var(--border-color);">
                <table class="w-full">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Title</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Author</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Price</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Status</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestProducts as $product)
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td class="text-white text-sm px-5 py-3 font-medium">
                                <a href="{{ route('products.show', $product) }}" class="hover:underline" style="color: var(--accent);">{{ Str::limit($product->title, 40) }}</a>
                            </td>
                            <td class="text-gray-400 text-sm px-5 py-3">{{ $product->user->name }}</td>
                            <td class="text-white text-sm px-5 py-3">{{ number_format($product->price) }} &#8376;</td>
                            <td class="px-5 py-3"><span class="text-xs px-2 py-1 rounded-full" style="background-color: var(--bg-input); color: #888;">{{ $product->status }}</span></td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('admin.products.delete', $product) }}" onsubmit="return confirm('Delete this product?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400 text-xs hover:text-red-300 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest Services -->
        <div>
            <h2 class="text-xl font-bold text-white mb-4">Latest Services</h2>
            <div class="glass border rounded-2xl overflow-hidden" style="border-color: var(--border-color);">
                <table class="w-full">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Title</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Author</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Price</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Status</th>
                            <th class="text-left text-gray-400 text-xs font-medium px-5 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestServices as $service)
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td class="text-white text-sm px-5 py-3 font-medium">
                                <a href="{{ route('services.show', $service) }}" class="hover:underline" style="color: var(--accent);">{{ Str::limit($service->title, 40) }}</a>
                            </td>
                            <td class="text-gray-400 text-sm px-5 py-3">{{ $service->user->name }}</td>
                            <td class="text-white text-sm px-5 py-3">{{ number_format($service->price) }} &#8376;</td>
                            <td class="px-5 py-3"><span class="text-xs px-2 py-1 rounded-full" style="background-color: var(--bg-input); color: #888;">{{ $service->status }}</span></td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('admin.services.delete', $service) }}" onsubmit="return confirm('Delete this service?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400 text-xs hover:text-red-300 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
