<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'QAJET') }} - @yield('title', 'Student Assistant')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --accent: #CDFF00;
                --accent-hover: #b8e600;
                --bg-primary: #0A0A0A;
                --bg-card: #111111;
                --bg-card-hover: #161616;
                --bg-input: #1a1a1a;
                --border-color: #1e1e1e;
                --glow-accent: rgba(205, 255, 0, 0.08);
                --glow-accent-strong: rgba(205, 255, 0, 0.15);
            }

            /* Sticker pattern background */
            .sticker-bg {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 0;
                pointer-events: none;
                opacity: 0.03;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='800' height='800'%3E%3Ctext x='50' y='80' font-size='40' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%8F%A0%3C/text%3E%3Ctext x='200' y='60' font-size='35' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%92%BB%3C/text%3E%3Ctext x='380' y='90' font-size='38' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%93%9A%3C/text%3E%3Ctext x='550' y='70' font-size='36' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%92%BC%3C/text%3E%3Ctext x='700' y='95' font-size='34' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%9B%92%3C/text%3E%3Ctext x='120' y='200' font-size='36' fill='%23ffffff' font-family='sans-serif'%3E%E2%9C%8F%EF%B8%8F%3C/text%3E%3Ctext x='300' y='220' font-size='40' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%8E%B8%3C/text%3E%3Ctext x='480' y='190' font-size='35' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%8F%AA%3C/text%3E%3Ctext x='650' y='210' font-size='38' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%92%AC%3C/text%3E%3Ctext x='30' y='340' font-size='37' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%8E%93%3C/text%3E%3Ctext x='180' y='360' font-size='34' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%92%A1%3C/text%3E%3Ctext x='350' y='330' font-size='40' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%96%A5%EF%B8%8F%3C/text%3E%3Ctext x='520' y='350' font-size='36' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%8F%A0%3C/text%3E%3Ctext x='680' y='340' font-size='35' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%93%96%3C/text%3E%3Ctext x='80' y='480' font-size='38' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%9B%8B%EF%B8%8F%3C/text%3E%3Ctext x='250' y='500' font-size='35' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%92%BC%3C/text%3E%3Ctext x='420' y='470' font-size='40' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%93%B1%3C/text%3E%3Ctext x='590' y='490' font-size='36' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%8E%A8%3C/text%3E%3Ctext x='740' y='475' font-size='34' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%92%BB%3C/text%3E%3Ctext x='40' y='620' font-size='36' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%93%9A%3C/text%3E%3Ctext x='200' y='640' font-size='38' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%8F%AA%3C/text%3E%3Ctext x='370' y='610' font-size='35' fill='%23ffffff' font-family='sans-serif'%3E%E2%9C%8F%EF%B8%8F%3C/text%3E%3Ctext x='530' y='630' font-size='40' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%8E%B8%3C/text%3E%3Ctext x='700' y='620' font-size='37' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%8E%93%3C/text%3E%3Ctext x='100' y='760' font-size='34' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%9B%92%3C/text%3E%3Ctext x='280' y='740' font-size='38' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%96%A5%EF%B8%8F%3C/text%3E%3Ctext x='460' y='760' font-size='36' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%92%A1%3C/text%3E%3Ctext x='620' y='745' font-size='35' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%9B%8B%EF%B8%8F%3C/text%3E%3Ctext x='760' y='770' font-size='40' fill='%23ffffff' font-family='sans-serif'%3E%F0%9F%93%B1%3C/text%3E%3C/svg%3E");
                background-size: 800px 800px;
                background-repeat: repeat;
            }

            /* Glassmorphism */
            .glass {
                background: rgba(17, 17, 17, 0.7) !important;
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.05) !important;
            }

            /* Card glow on hover */
            .card-glow {
                transition: all 0.3s ease;
                box-shadow: 0 0 0 rgba(205, 255, 0, 0);
            }
            .card-glow:hover {
                box-shadow: 0 0 25px rgba(205, 255, 0, 0.08), 0 0 50px rgba(205, 255, 0, 0.04);
                border-color: rgba(205, 255, 0, 0.2) !important;
                transform: translateY(-2px);
            }

            /* Gradient border under nav */
            .nav-glow {
                position: relative;
            }
            .nav-glow::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(205, 255, 0, 0.3), transparent);
            }

            /* Button glow */
            .btn-accent {
                background-color: var(--accent);
                color: #000;
                font-weight: 700;
                transition: all 0.3s ease;
                box-shadow: 0 0 15px rgba(205, 255, 0, 0.15);
            }
            .btn-accent:hover {
                background-color: var(--accent-hover);
                box-shadow: 0 0 25px rgba(205, 255, 0, 0.3);
                transform: translateY(-1px);
            }

            /* Subtle noise texture overlay */
            .noise-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 0;
                pointer-events: none;
                opacity: 0.015;
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
                background-size: 256px 256px;
            }

            /* Input focus glow */
            input:focus, select:focus, textarea:focus {
                box-shadow: 0 0 0 2px rgba(205, 255, 0, 0.2) !important;
            }

            /* Smooth scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }
            ::-webkit-scrollbar-track {
                background: #0A0A0A;
            }
            ::-webkit-scrollbar-thumb {
                background: #333;
                border-radius: 3px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }
        </style>
    </head>
    <body class="font-sans antialiased" style="background-color: var(--bg-primary);">
        <!-- Background layers -->
        <div class="sticker-bg"></div>
        <div class="noise-overlay"></div>

        <div class="min-h-screen relative" style="z-index: 1;">
            @include('layouts.navigation')

            @if(session('success'))
                <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                    <div class="glass text-green-400 px-4 py-3 rounded-2xl border border-green-800/30">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
                    <div class="glass text-red-400 px-4 py-3 rounded-2xl border border-red-800/30">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @isset($header)
                <header class="glass">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>

            <footer class="border-t mt-16 relative" style="background: linear-gradient(180deg, rgba(17,17,17,0.9), rgba(10,10,10,1)); border-color: rgba(255,255,255,0.05);">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                        <div>
                            <div class="text-2xl font-bold text-white mb-3">
                                <span style="color: var(--accent);">QA</span>JET
                            </div>
                            <p class="text-gray-500 text-sm">Your ultimate student assistant platform. Built for students, by students.</p>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-3">Platform</h4>
                            <div class="space-y-2">
                                <a href="{{ route('listings.index') }}" class="block text-gray-500 hover:text-white text-sm transition">Roommates</a>
                                <a href="{{ route('products.index') }}" class="block text-gray-500 hover:text-white text-sm transition">Marketplace</a>
                                <a href="{{ route('services.index') }}" class="block text-gray-500 hover:text-white text-sm transition">Services</a>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-3">Contact</h4>
                            <p class="text-gray-500 text-sm">KBTU, Almaty, Kazakhstan</p>
                            <p class="text-gray-500 text-sm mt-1">qajet@kbtu.kz</p>
                        </div>
                    </div>
                    <div class="border-t pt-6" style="border-color: rgba(255,255,255,0.05);">
                        <p class="text-gray-600 text-sm text-center">&copy; {{ date('Y') }} QAJET. Student Assistant Platform. KBTU.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
