<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h1 class="text-2xl font-bold text-blue-900 mb-4">Verifikasi Foto Wajah</h1>
            <div class="mb-6 flex justify-center">
                <img src="{{ Storage::url($attendance->photo_selfie) }}" class="rounded-xl shadow-lg max-w-xs">
            </div>
            <div class="flex justify-center gap-4">
                <form action="{{ route('admin.attendances.verify-face.post', $attendance) }}" method="POST">
                    @csrf
                    <input type="hidden" name="verified" value="1">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-xl">✅ Sesuai</button>
                </form>
                <form action="{{ route('admin.attendances.verify-face.post', $attendance) }}" method="POST">
                    @csrf
                    <input type="hidden" name="verified" value="0">
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-xl">❌ Tidak Sesuai</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>