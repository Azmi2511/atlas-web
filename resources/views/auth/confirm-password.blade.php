<x-guest-layout>
    <div class="text-center mb-6">
        <i class="fas fa-shield-alt text-indigo-500 text-4xl mb-2"></i>
        <h2 class="text-2xl font-bold text-gray-800">Konfirmasi Kata Sandi</h2>
        <p class="text-gray-600 text-sm mt-1">Harap konfirmasi kata sandi Anda sebelum melanjutkan</p>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Ini adalah area aman dari aplikasi. Harap konfirmasi kata sandi Anda sebelum melanjutkan.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
                <x-text-input id="password" class="block w-full pl-10" type="password" name="password" required autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                {{ __('Konfirmasi') }}
                <i class="fas fa-check-circle ms-2"></i>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>