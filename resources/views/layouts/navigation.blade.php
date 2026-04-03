<nav x-data="{ open: false }" class="nav-glow glass" style="border-bottom: none;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                        <span style="color: var(--accent);">QA</span>JET
                    </a>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-3 pt-1 text-sm font-medium rounded-lg transition {{ request()->routeIs('home') ? 'text-black' : 'text-gray-400 hover:text-white' }}" style="{{ request()->routeIs('home') ? 'color: #000; background-color: var(--accent);' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('listings.index') }}" class="inline-flex items-center px-3 pt-1 text-sm font-medium rounded-lg transition {{ request()->routeIs('listings.*') ? 'text-black' : 'text-gray-400 hover:text-white' }}" style="{{ request()->routeIs('listings.*') ? 'color: #000; background-color: var(--accent);' : '' }}">
                        Roommates
                    </a>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-3 pt-1 text-sm font-medium rounded-lg transition {{ request()->routeIs('products.*') ? 'text-black' : 'text-gray-400 hover:text-white' }}" style="{{ request()->routeIs('products.*') ? 'color: #000; background-color: var(--accent);' : '' }}">
                        Marketplace
                    </a>
                    <a href="{{ route('services.index') }}" class="inline-flex items-center px-3 pt-1 text-sm font-medium rounded-lg transition {{ request()->routeIs('services.*') ? 'text-black' : 'text-gray-400 hover:text-white' }}" style="{{ request()->routeIs('services.*') ? 'color: #000; background-color: var(--accent);' : '' }}">
                        Services
                    </a>
                    @auth
                    <a href="{{ route('chats.index') }}" class="inline-flex items-center px-3 pt-1 text-sm font-medium rounded-lg transition {{ request()->routeIs('chats.*') ? 'text-black' : 'text-gray-400 hover:text-white' }}" style="{{ request()->routeIs('chats.*') ? 'color: #000; background-color: var(--accent);' : '' }}">
                        Community
                    </a>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-gray-300 hover:text-white focus:outline-none transition" style="background-color: var(--bg-input);">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            @can('admin')
                            <x-dropdown-link :href="route('admin.dashboard')">
                                {{ __('Admin Panel') }}
                            </x-dropdown-link>
                            @endcan
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-white text-sm font-medium mr-4">Log in</a>
                    <a href="{{ route('register') }}" class="text-black text-sm font-bold px-5 py-2 rounded-xl transition" style="background-color: var(--accent);">Register</a>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background-color: var(--bg-card);">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-gray-300 hover:text-white">Home</a>
            <a href="{{ route('listings.index') }}" class="block px-3 py-2 rounded-lg text-gray-300 hover:text-white">Roommates</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-lg text-gray-300 hover:text-white">Marketplace</a>
            <a href="{{ route('services.index') }}" class="block px-3 py-2 rounded-lg text-gray-300 hover:text-white">Services</a>
            @auth
            <a href="{{ route('chats.index') }}" class="block px-3 py-2 rounded-lg text-gray-300 hover:text-white">Community</a>
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-1 border-t" style="border-color: var(--border-color);">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-gray-300 hover:text-white">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-gray-300 hover:text-white">Log Out</button>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
