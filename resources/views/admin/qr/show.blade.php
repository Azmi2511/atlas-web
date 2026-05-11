<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="bg-white rounded-2xl shadow-md p-6 text-center">
            <h1 class="text-2xl font-bold text-blue-900 mb-4">QR Code Berhasil Dibuat</h1>
            <div class="flex justify-center mb-4">
                {!! $qrImage !!}
            </div>
            <p class="text-sm text-gray-600 mb-2">Token: <code class="bg-gray-100 px-2 py-1 rounded">{{ $token }}</code></p>
            <p class="text-sm text-gray-600 mb-4">Gunakan QR ini untuk absensi siswa.</p>
            <a href="{{ route('admin.qr.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-xl">Kembali</a>
        </div>
    </div>
</div>
</x-app-layout>