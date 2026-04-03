<x-app-layout>
    @section('title', 'Sell Item')

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('products.index') }}" style="color: var(--accent);" class="text-sm mb-4 inline-block">&larr; Back</a>
        <h1 class="text-3xl font-bold text-white mb-8">Sell an Item</h1>

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" style="border-color: var(--border-color);" class="glass border rounded-2xl p-6 space-y-6">
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
                    <label class="block text-gray-300 text-sm font-medium mb-2">Condition</label>
                    <select name="condition" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg focus:ring-yellow-400 focus:border-yellow-400" required>
                        <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="like_new" {{ old('condition') == 'like_new' ? 'selected' : '' }}>Like New</option>
                        <option value="used" {{ old('condition') == 'used' ? 'selected' : '' }}>Used</option>
                        <option value="poor" {{ old('condition') == 'poor' ? 'selected' : '' }}>Poor</option>
                    </select>
                    @error('condition') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
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
                <input type="file" name="image" accept="image/*" style="background-color: var(--bg-input); border-color: var(--border-color);" class="w-full text-white rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-black">
                @error('image') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-accent w-full font-semibold py-3 rounded-xl transition text-lg">List for Sale</button>
        </form>
    </div>
</x-app-layout>
