<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Smart Attendance') }} - Akses Sistem</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-900 via-blue-700 to-blue-800 relative overflow-hidden">
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse delay-1000"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-600 rounded-full filter blur-3xl opacity-20 animate-pulse delay-500"></div>
            </div>
            <div class="text-center mb-6 relative z-10">
                <a href="/" class="inline-block transition-transform hover:scale-105 duration-300">
                    <x-application-logo class="w-20 h-20 fill-current text-blue-300 mx-auto drop-shadow-lg" />
                </a>
                <h1 class="mt-4 text-3xl font-extrabold text-white tracking-tight">{{ config('app.name', 'Smart Attendance') }}</h1>
                <p class="text-blue-200 text-sm mt-1">Attendance Tracking via Live Authentication System</p>
            </div>
            <div class="w-full sm:max-w-md mt-4 px-6 py-8 bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl border border-white/50 relative z-10 transition-all duration-500 hover:shadow-xl">
                {{ $slot }}
            </div>
            <div class="mt-8 text-center text-xs text-blue-200 relative z-10 space-x-3">
                <span><i class="fas fa-shield-alt mr-1"></i> Terenkripsi & Aman</span>
                <span class="mx-1">•</span>
                <span><i class="fas fa-clock mr-1"></i> Realtime</span>
                <span class="mx-1">•</span>
                <span><i class="fas fa-graduation-cap mr-1"></i> Berkarakter</span>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>