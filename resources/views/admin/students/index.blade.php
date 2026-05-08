<x-app-layout>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-3xl font-bold text-blue-900 flex items-center gap-2">
                <i class="fas fa-user-graduate text-blue-600"></i>
                Manajemen Siswa
            </h1>
            @can('manage students')
            <a href="{{ route('students.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg">
                <i class="fas fa-plus-circle"></i>
                Tambah Siswa
            </a>
            @endcan
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-blue-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-blue-100">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">NISN</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">JK</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-50 bg-white">
                        @forelse($students as $student)
                        <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-slate-600">{{ $student->nisn }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">{{ $student->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $student->classroom?->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $student->gender == 'L' ? 'Laki-laki' : ($student->gender == 'P' ? 'Perempuan' : '-') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($student->is_active)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-circle text-[6px] mr-1 text-green-600"></i> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-circle text-[6px] mr-1 text-red-600"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                <a href="{{ route('students.show', $student) }}" class="text-green-600 hover:text-green-800 transition">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('manage students')
                                <a href="{{ route('students.edit', $student) }}" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition" onclick="return confirm('Yakin hapus siswa ini? Akun user juga akan terhapus.')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <i class="fas fa-user-graduate text-4xl text-blue-200 mb-2 block"></i>
                                Belum ada data siswa
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $students->links() }}
        </div>
    </div>
</x-app-layout>