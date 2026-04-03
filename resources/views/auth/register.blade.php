<x-guest-layout>
    @section('title', 'Register')

    <!-- Tab Toggle -->
    <div class="flex mb-6 rounded-xl overflow-hidden" style="background-color: var(--bg-input);">
        <a href="{{ route('login') }}" class="flex-1 py-3 text-center text-sm font-medium text-gray-400 hover:text-white transition">
            Login
        </a>
        <a href="{{ route('register') }}" class="flex-1 py-3 text-center text-sm font-bold rounded-xl" style="background-color: var(--accent); color: #000;">
            Register
        </a>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-gray-300 text-sm font-medium mb-2">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full border-0 text-white rounded-xl px-4 py-3 focus:ring-2 placeholder-gray-600"
                style="background-color: var(--bg-input);"
                placeholder="Enter your name">
            @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-gray-300 text-sm font-medium mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full border-0 text-white rounded-xl px-4 py-3 focus:ring-2 placeholder-gray-600"
                style="background-color: var(--bg-input);"
                placeholder="your@email.com">
            @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-gray-300 text-sm font-medium mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full border-0 text-white rounded-xl px-4 py-3 focus:ring-2 placeholder-gray-600"
                style="background-color: var(--bg-input);"
                placeholder="Enter password">
            @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-gray-300 text-sm font-medium mb-2">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full border-0 text-white rounded-xl px-4 py-3 focus:ring-2 placeholder-gray-600"
                style="background-color: var(--bg-input);"
                placeholder="Confirm password">
        </div>

        <button type="submit" class="w-full font-bold py-3 rounded-xl text-lg transition" style="background-color: var(--accent); color: #000;">
            Register
        </button>
    </form>
</x-guest-layout>
