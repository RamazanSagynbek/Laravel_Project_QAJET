<x-app-layout>
    @section('title', 'Edit Listing')

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('listings.show', $listing) }}" style="color: var(--accent);" class="text-sm mb-4 inline-block">&larr; Back</a>
        <h1 class="text-3xl font-bold text-white mb-8">Edit Listing</h1>

        <form method="POST" action="{{ route('listings.update', $listing) }}" enctype="multipart/form-data" style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 space-y-6">
            @csrf @method('PUT')

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Type</label>
                <select name="type" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                    <option value="offering_room" {{ old('type', $listing->type) == 'offering_room' ? 'selected' : '' }}>Offering Room</option>
                    <option value="looking_for_room" {{ old('type', $listing->type) == 'looking_for_room' ? 'selected' : '' }}>Looking for Room</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title', $listing->title) }}" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Description</label>
                <textarea name="description" rows="5" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>{{ old('description', $listing->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Price (&#8376;/month)</label>
                    <input type="number" name="price" value="{{ old('price', $listing->price) }}" step="0.01" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">City</label>
                    <input type="text" name="city" value="{{ old('city', $listing->city) }}" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Address</label>
                <input type="text" name="address" value="{{ old('address', $listing->address) }}" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Rooms</label>
                    <input type="number" name="rooms" value="{{ old('rooms', $listing->rooms) }}" min="1" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Roommates Needed</label>
                    <input type="number" name="roommates_needed" value="{{ old('roommates_needed', $listing->roommates_needed) }}" min="1" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Image</label>
                @if($listing->image)
                    <img src="{{ Storage::url($listing->image) }}" class="w-32 h-32 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="image" accept="image/*" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-black">
            </div>

            <button type="submit" class="btn-accent w-full font-semibold py-3 rounded-xl transition text-lg">Update Listing</button>
        </form>
    </div>
</x-app-layout>
