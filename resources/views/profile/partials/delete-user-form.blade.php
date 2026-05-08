<section class="space-y-6">
    <div class="flex items-start gap-4">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
        </div>
        <div>
            <h3 class="text-lg font-medium text-gray-900">{{ __('Hapus Akun') }}</h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Setelah akun Anda dihapus, semua data dan resource akan dihapus secara permanen. Sebelum menghapus, unduh data yang ingin Anda simpan.') }}
            </p>
        </div>
    </div>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-600 hover:bg-red-700 transition">
        <i class="fas fa-trash-alt mr-2"></i> {{ __('Hapus Akun') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Setelah akun dihapus, semua data akan hilang permanen. Masukkan kata sandi Anda untuk konfirmasi.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <x-text-input id="password" name="password" type="password" class="block w-full pl-10" placeholder="{{ __('Kata Sandi') }}" />
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>
                <x-danger-button class="bg-red-600 hover:bg-red-700">
                    <i class="fas fa-trash-alt mr-2"></i> {{ __('Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>