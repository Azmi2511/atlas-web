<x-app-layout>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h1 class="text-3xl font-bold text-blue-900 flex items-center gap-2">
                <i class="fas fa-school text-blue-600"></i>
                Manajemen Kelas
            </h1>
            @can('manage classes')
            <a href="{{ route('classes.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md transition-all duration-300 hover:shadow-lg">
                <i class="fas fa-plus-circle"></i>
                Tambah Kelas
            </a>
            @endcan
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-blue-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-blue-100">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Nama Kelas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Tingkat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Wali Kelas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Tahun Ajaran</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-50 bg-white">
                        @foreach($classrooms as $class)
                        <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">{{ $class->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $class->grade }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $class->teacher?->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $class->academic_year ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                <a href="{{ route('classes.students', $class) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    <i class="fas fa-users mr-1"></i> Siswa
                                </a>
                                @can('manage classes')
                                <a href="{{ route('classes.edit', $class) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('classes.destroy', $class) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition-colors duration-200" onclick="return confirm('Yakin ingin menghapus kelas ini? Semua data siswa dalam kelas ini juga akan terpengaruh.')">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $classrooms->links() }}
        </div>
    </div>
</x-app-layout>