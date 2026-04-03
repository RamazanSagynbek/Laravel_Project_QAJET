<x-app-layout>
    @section('title', 'Offer Service')

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('services.index') }}" style="color: var(--accent);" class="hover:opacity-80 text-sm mb-4 inline-block">&larr; Back</a>
        <h1 class="text-3xl font-bold text-white mb-8">Offer a Service</h1>

        <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data" style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 space-y-6">
            @csrf

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
                    <label class="block text-gray-300 text-sm font-medium mb-2">Price (&#8376;)</label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                    @error('price') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Price Type</label>
                    <select name="price_type" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                        <option value="fixed" {{ old('price_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="hourly" {{ old('price_type') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                        <option value="negotiable" {{ old('price_type') == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                    </select>
                    @error('price_type') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Category</label>
                <select name="category_id" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400">
                    <option value="">No Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Image</label>
                <input type="file" name="image" accept="image/*" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-yellow-400 file:text-black hover:file:bg-yellow-300">
                @error('image') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-accent w-full font-semibold py-3 rounded-xl transition text-lg hover:opacity-80">Offer Service</button>
        </form>
    </div>
</x-app-layout>
