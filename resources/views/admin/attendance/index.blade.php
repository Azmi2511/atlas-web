<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-3xl font-extrabold text-blue-900">Manajemen Kehadiran</h1>
            @can('manage attendances')
            <a href="{{ route('attendance.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md transition">
                <i class="fas fa-plus-circle"></i> Absen Massal
            </a>
            @endcan
        </div>

        {{-- Filter --}}
        <div class="bg-white rounded-2xl shadow-md p-5 mb-6">
            <form method="GET" action="{{ route('attendance.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Kelas</label>
                    <select name="class_id" class="w-full rounded-xl border-blue-200 focus:ring-blue-200">
                        <option value="">Semua Kelas</option>
                        @foreach($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ request('class_id') == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Status</label>
                    <select name="status" class="w-full rounded-xl border-blue-200">
                        <option value="">Semua</option>
                        <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpha" {{ request('status') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                </div>
                <div>
                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Tanggal</label>
                    <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}" class="w-full rounded-xl border-blue-200">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700">Filter</button>
                    <a href="{{ route('attendance.index') }}" class="ml-2 text-gray-600 hover:underline">Reset</a>
                </div>
            </form>
        </div>

        {{-- Tabel --}}
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-blue-100">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-blue-700 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-50">
                        @forelse($attendances as $att)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $att->date->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $att->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $att->classroom->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $att->check_in_time->format('H:i:s') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">@include('components.attendance-badge', ['status' => $att->status])</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('attendance.show', $att) }}" class="text-blue-600 hover:underline">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada data kehadiran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">{{ $attendances->appends(request()->query())->links() }}</div>
    </div>
</div>
</x-app-layout>