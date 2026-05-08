<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" />
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fas fa-lock"></i>
                </span>
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full pl-10" autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div>
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" />
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fas fa-key"></i>
                </span>
                <x-text-input id="update_password_password" name="password" type="password" class="block w-full pl-10" autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirm New Password -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" />
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fas fa-check-circle"></i>
                </span>
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full pl-10" autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 transition">
                <i class="fas fa-save mr-2"></i> {{ __('Ubah Kata Sandi') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600 flex items-center gap-1">
                    <i class="fas fa-check-circle"></i> Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>