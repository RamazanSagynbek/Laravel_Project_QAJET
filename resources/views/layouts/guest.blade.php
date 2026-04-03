<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'QAJET') }} - @yield('title', 'Auth')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --accent: #CDFF00;
                --accent-hover: #b8e600;
                --bg-primary: #000000;
                --bg-card: #111111;
                --bg-input: #1a1a1a;
                --border-color: #222222;
            }
        </style>
    </head>
    <body class="font-sans antialiased" style="background-color: var(--bg-primary);">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md">
                <!-- Hero gradient -->
                <div class="rounded-t-3xl px-8 pt-12 pb-8 text-center" style="background: linear-gradient(135deg, #2a3a00 0%, #1a2400 50%, #111 100%);">
                    <a href="{{ route('home') }}" class="text-3xl font-bold text-white">
                        <span style="color: var(--accent);">QA</span>JET
                    </a>
                    <h2 class="text-2xl font-bold text-white mt-6">Welcome back</h2>
                    <p class="text-gray-400 mt-2 text-sm">Sign in or register to get started</p>
                </div>

                <!-- Content -->
                <div class="rounded-b-3xl px-8 py-8" style="background-color: var(--bg-card);">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
