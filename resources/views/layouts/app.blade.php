<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sakhai') }} - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Additional Styles from child views --}}
    @stack('styles')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Hide elements until Alpine.js loads */
        [x-cloak] {
            display: none !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #1E1E1E;
        }
        ::-webkit-scrollbar-thumb {
            background: #414141;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #595959;
        }

        /* DARK THEME FORM ELEMENTS FIX */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="url"],
        input[type="tel"],
        input[type="search"],
        textarea,
        select {
            background-color: #2A2A2A !important;
            border-color: #414141 !important;
            color: #ffffff !important;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="number"]:focus,
        input[type="url"]:focus,
        input[type="tel"]:focus,
        input[type="search"]:focus,
        textarea:focus,
        select:focus {
            background-color: #2A2A2A !important;
            border-color: #2D68F8 !important;
            outline: none !important;
            box-shadow: 0 0 0 1px #2D68F8 !important;
        }

        input::placeholder,
        textarea::placeholder {
            color: #595959 !important;
        }

        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23595959' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e") !important;
            background-position: right 0.75rem center !important;
            background-repeat: no-repeat !important;
            background-size: 1.5em 1.5em !important;
            padding-right: 2.5rem !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
        }

        select option {
            background-color: #2A2A2A !important;
            color: #ffffff !important;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active,
        textarea:-webkit-autofill,
        select:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px #2A2A2A inset !important;
            -webkit-text-fill-color: #ffffff !important;
            border-color: #414141 !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }

        [type='text']:focus,
        [type='email']:focus,
        [type='url']:focus,
        [type='password']:focus,
        [type='number']:focus,
        textarea:focus,
        select:focus {
            --tw-ring-color: transparent !important;
            --tw-ring-shadow: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-[#121212] text-white">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        @include('layouts.navigation')

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-h-screen lg:ml-64">
            {{-- Top Header --}}
            <header class="bg-[#1E1E1E] border-b border-[#2A2A2A] sticky top-0 z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    {{-- Mobile Menu Button --}}
                    <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-[#2A2A2A] text-[#A0A0A0]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    {{-- Page Title --}}
                    @if (isset($header))
                        <div class="flex-1">
                            {{ $header }}
                        </div>
                    @endif

                    {{-- User Dropdown --}}
                    <div class="flex items-center gap-4">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-3 p-2 rounded-lg hover:bg-[#2A2A2A] transition-colors">
                                <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                                     class="w-8 h-8 rounded-full object-cover border-2 border-[#414141]"
                                     alt="{{ Auth::user()->name }}">
                                <div class="hidden md:block text-left">
                                    <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-[#A0A0A0]">{{ Auth::user()->occupation }}</p>
                                </div>
                                <svg class="w-4 h-4 text-[#595959]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            {{-- Dropdown Menu --}}
                            <div x-show="open"
                                 x-cloak
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-[#2A2A2A] rounded-xl shadow-lg border border-[#414141] py-1 z-50">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-[#A0A0A0] hover:bg-[#363636] hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Mobile Sidebar Overlay --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/70 z-40 lg:hidden hidden"></div>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        if (mobileMenuBtn && sidebar && sidebarOverlay) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            });

            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });
        }
    </script>

    {{-- Additional Scripts from child views (untuk Chart.js dll) --}}
    @stack('scripts')
</body>

</html>
