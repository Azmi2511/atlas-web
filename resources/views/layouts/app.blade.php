<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Atlas') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-[Figtree] antialiased bg-blue-50 text-slate-700">
    <div class="flex min-h-screen">
        <aside class="hidden lg:flex lg:w-72 flex-col bg-gradient-to-b from-blue-900 via-blue-800 to-blue-900 border-r border-blue-700 shadow-xl">
            <div class="h-20 flex items-center px-8 border-b border-blue-700/50">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center shadow-lg shadow-black/20">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10">
                    </div>
                    <div>
                        <h1 class="text-white text-xl font-bold tracking-wide">
                            {{ config('app.name', 'Atlas') }}
                        </h1>
                        <p class="text-blue-200 text-[7px] tracking-wider">
                            Attendance Tracking via Live Authentication System
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto py-4">
                @include('layouts.navigation')
            </div>
        </aside>
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="h-20 bg-white/90 backdrop-blur-sm border-b border-blue-100 px-6 lg:px-10 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden h-11 w-11 rounded-xl border border-blue-200 bg-white flex items-center justify-center text-blue-600 hover:bg-blue-50 transition">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h2 class="text-2xl font-bold text-blue-800">
                            Panel {{ Str::ucfirst(Auth::user()->getRoleNames()->first() ?? 'User') }}
                        </h2>
                        <p class="text-sm text-blue-500">
                            Selamat Datang Kembali, {{ Str::ucfirst(Auth::user()->name ?? 'Tamu') }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <button class="relative h-11 w-11 rounded-2xl bg-blue-50 hover:bg-blue-100 transition-all duration-300 flex items-center justify-center text-blue-600">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-2 right-2 h-2.5 w-2.5 rounded-full bg-blue-500 ring-2 ring-white"></span>
                    </button>
                    <div class="flex items-center gap-3 pl-3 border-l border-blue-200">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button class="flex items-center gap-3 group">
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Tamu' }}&background=1e3a8a&color=fff"
                                        class="h-10 w-10 rounded-2xl object-cover shadow-sm">
                                    <div class="hidden md:block text-left">
                                        <h4 class="font-semibold text-slate-700 group-hover:text-blue-600 transition">
                                            {{ Auth::user()->name ?? 'Tamu' }}
                                        </h4>
                                        <p class="text-sm text-slate-400">
                                            {{ Str::ucfirst(Auth::user()->getRoleNames()->first() ?? 'User') }}
                                        </p>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profil') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </header>
            @isset($header)
                <div class="bg-white/60 border-b border-blue-100 px-6 lg:px-10 py-5">
                    {{ $header }}
                </div>
            @endisset
            <main class="flex-1 overflow-y-auto overflow-x-auto bg-gradient-to-br from-blue-50 via-white to-blue-100/30">
                <div class="mx-auto">
                    {{ $slot }}
                </div>
            </main>
            <footer class="bg-white/80 backdrop-blur-sm border-t border-blue-100 px-6 lg:px-10 py-5">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-blue-600">
                            © {{ date('Y') }} {{ config('app.name', 'Atlas') }}. All rights reserved.
                        </p>
                    </div>
                    <div class="flex items-center gap-6 text-sm text-blue-500">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-shield-halved text-blue-400"></i>
                            <span>Secure System</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock text-blue-400"></i>
                            <span>Realtime Monitoring</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-database text-blue-400"></i>
                            <span>Cloud Integrated</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>