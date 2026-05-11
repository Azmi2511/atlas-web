<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="mb-4">
            <a href="{{ route('attendance.index') }}" class="text-blue-600 hover:underline">&larr; Kembali</a>
        </div>
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="px-6 py-5 bg-blue-50 border-b border-blue-100 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-900">Detail Kehadiran</h1>
                @can('manage attendances')
                <a href="{{ route('admin.attendance.edit', $attendance) }}" class="text-blue-600 hover:underline"><i class="fas fa-edit"></i> Edit</a>
                @endcan
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div><span class="text-blue-600 font-semibold">Nama:</span> {{ $attendance->user->name }}</div>
                <div><span class="text-blue-600 font-semibold">Kelas:</span> {{ $attendance->classrooms->name ?? '-' }}</div>
                <div><span class="text-blue-600 font-semibold">Tanggal:</span> {{ $attendance->date->format('d-m-Y') }}</div>
                <div><span class="text-blue-600 font-semibold">Waktu Check-in:</span> {{ $attendance->check_in_time->format('H:i:s') }}</div>
                <div><span class="text-blue-600 font-semibold">Status:</span> @include('components.attendance-badge', ['status' => $attendance->status])</div>
                <div><span class="text-blue-600 font-semibold">Pencatat:</span> {{ $attendance->verifier->name ?? '-' }}</div>
                <div class="md:col-span-2"><span class="text-blue-600 font-semibold">Lokasi GPS:</span> {{ $attendance->latitude }}, {{ $attendance->longitude }}</div>
                @if($attendance->photo_selfie)
                <div class="md:col-span-2">
                    <span class="text-blue-600 font-semibold">Foto Selfie:</span>
                    <div class="mt-2"><img src="{{ Storage::url($attendance->photo_selfie) }}" class="rounded-xl shadow max-w-xs"></div>
                </div>
                @endif
                <div class="md:col-span-2">
                    <span class="text-blue-600 font-semibold">Verifikasi Wajah:</span>
                    @if($attendance->face_matched)
                        <span class="text-green-600">✓ Sesuai</span>
                    @else
                        <span class="text-red-600">✗ Tidak Sesuai</span>
                        @can('manage attendances')
                        <a href="{{ route('attendance.verify-face', $attendance) }}" class="ml-2 text-blue-600 hover:underline">Verifikasi Manual</a>
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>