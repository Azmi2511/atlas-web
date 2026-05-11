<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="px-6 py-5 bg-blue-50 border-b border-blue-100">
                <h1 class="text-2xl font-bold text-blue-900">Edit Status Kehadiran</h1>
            </div>
            <form action="{{ route('admin.attendances.update', $attendance) }}" method="POST" class="p-6">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block text-blue-800 font-semibold mb-1">Status</label>
                    <select name="status" class="w-full rounded-xl border-blue-200" required>
                        <option value="hadir" {{ $attendance->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ $attendance->status == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ $attendance->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpha" {{ $attendance->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-blue-800 font-semibold mb-1">Catatan (opsional)</label>
                    <textarea name="note" rows="3" class="w-full rounded-xl border-blue-200">{{ old('note') }}</textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.attendances.show', $attendance) }}" class="px-4 py-2 bg-gray-300 rounded-xl">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>