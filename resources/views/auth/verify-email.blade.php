<x-guest-layout>
    <div class="text-center mb-6">
        <i class="fas fa-envelope-open-text text-indigo-500 text-5xl mb-3"></i>
        <h2 class="text-2xl font-bold text-gray-800">Verifikasi Email</h2>
        <p class="text-gray-600 text-sm mt-1">Konfirmasi alamat email Anda</p>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang kami kirimkan. Jika Anda tidak menerima email, kami dengan senang hati mengirimkan ulang.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-lg">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                {{ __('Kirim Ulang Email Verifikasi') }}
                <i class="fas fa-paper-plane ms-2"></i>
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Logout') }}
            </button>
        </form>
    </div>
</x-guest-layout>