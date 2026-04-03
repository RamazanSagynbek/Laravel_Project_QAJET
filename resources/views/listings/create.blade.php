<x-app-layout>
    @section('title', 'New Listing')

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('listings.index') }}" style="color: var(--accent);" class="text-sm mb-4 inline-block">&larr; Back</a>
        <h1 class="text-3xl font-bold text-white mb-8">Create Listing</h1>

        <form method="POST" action="{{ route('listings.store') }}" enctype="multipart/form-data" style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 space-y-6">
            @csrf

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Type</label>
                <select name="type" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                    <option value="offering_room" {{ old('type') == 'offering_room' ? 'selected' : '' }}>Offering Room</option>
                    <option value="looking_for_room" {{ old('type') == 'looking_for_room' ? 'selected' : '' }}>Looking for Room</option>
                </select>
                @error('type') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Description</label>
                <textarea name="description" rows="5" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>{{ old('description') }}</textarea>
                @error('description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Price (&#8376;/month)</label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                    @error('price') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">City</label>
                    <input type="text" name="city" value="{{ old('city', 'Almaty') }}" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                    @error('city') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Address</label>
                <input type="text" name="address" value="{{ old('address') }}" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                @error('address') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Rooms</label>
                    <input type="number" name="rooms" value="{{ old('rooms', 1) }}" min="1" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                    @error('rooms') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Roommates Needed</label>
                    <input type="number" name="roommates_needed" value="{{ old('roommates_needed', 1) }}" min="1" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                    @error('roommates_needed') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Image</label>
                <input type="file" name="image" accept="image/*" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-black">
                @error('image') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-accent w-full font-semibold py-3 rounded-xl transition text-lg">Create Listing</button>
        </form>
    </div>
</x-app-layout>
