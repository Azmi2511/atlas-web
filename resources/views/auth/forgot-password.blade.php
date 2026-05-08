<x-guest-layout>
    <div class="text-center mb-6">
        <i class="fas fa-key text-indigo-500 text-4xl mb-2"></i>
        <h2 class="text-2xl font-bold text-gray-800">Lupa Kata Sandi?</h2>
        <p class="text-gray-600 text-sm mt-1">Tenang, kami akan kirimkan tautan reset ke email Anda</p>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa kata sandi? Tidak masalah. Cukup beritahu kami alamat email Anda dan kami akan mengirimkan tautan reset kata sandi yang memungkinkan Anda memilih yang baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fas fa-envelope"></i>
                </span>
                <x-text-input id="email" class="block w-full pl-10" type="email" name="email" :value="old('email')" required autofocus />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke login
            </a>
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                {{ __('Kirim Tautan Reset') }}
                <i class="fas fa-paper-plane ms-2"></i>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>