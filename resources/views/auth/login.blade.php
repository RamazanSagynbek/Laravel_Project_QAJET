<x-guest-layout>
    @section('title', 'Login')

    <!-- Tab Toggle -->
    <div class="flex mb-6 rounded-xl overflow-hidden" style="background-color: var(--bg-input);">
        <a href="{{ route('login') }}" class="flex-1 py-3 text-center text-sm font-bold rounded-xl" style="background-color: var(--accent); color: #000;">
            Login
        </a>
        <a href="{{ route('register') }}" class="flex-1 py-3 text-center text-sm font-medium text-gray-400 hover:text-white transition">
            Register
        </a>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-gray-300 text-sm font-medium mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full border-0 text-white rounded-xl px-4 py-3 focus:ring-2 placeholder-gray-600"
                style="background-color: var(--bg-input); focus: ring-color: var(--accent);"
                placeholder="your@email.com">
            @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-gray-300 text-sm font-medium mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full border-0 text-white rounded-xl px-4 py-3 focus:ring-2 placeholder-gray-600"
                style="background-color: var(--bg-input);"
                placeholder="Enter password">
            @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-600 text-yellow-400 shadow-sm focus:ring-yellow-400" style="background-color: var(--bg-input);" name="remember">
                <span class="ms-2 text-sm text-gray-400">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm hover:underline" style="color: var(--accent);" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full font-bold py-3 rounded-xl text-lg transition" style="background-color: var(--accent); color: #000;">
            Sign In
        </button>
    </form>
</x-guest-layout>
