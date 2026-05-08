<x-app-layout>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="mb-6">
            <div class="flex items-center gap-2 mb-2">
                <a href="{{ route('classes.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <i class="fas fa-arrow-left"></i> Kembali ke Kelas
                </a>
            </div>
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-blue-900 flex items-center gap-2">
                            <i class="fas fa-users text-blue-600"></i>
                            Siswa Kelas {{ $class->name }}
                        </h1>
                        <div class="mt-2 space-y-1">
                            <p class="text-blue-700">
                                <i class="fas fa-chalkboard-user text-blue-400 w-5"></i>
                                Wali Kelas: <span class="font-semibold">{{ $class->teacher?->name ?? 'Belum ditentukan' }}</span>
                            </p>
                            @if($class->academic_year)
                            <p class="text-blue-600 text-sm">
                                <i class="fas fa-calendar-alt text-blue-400 w-5"></i>
                                Tahun Ajaran: {{ $class->academic_year }}
                            </p>
                            @endif
                        </div>
                    </div>
                    @can('manage classes')
                    <div class="flex gap-2">
                        <a href="{{ route('classes.edit', $class) }}" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 text-sm font-medium">
                            <i class="fas fa-edit"></i> Edit Kelas
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-blue-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-blue-100">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                <i class="fas fa-user mr-1"></i> Nama
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                <i class="fas fa-envelope mr-1"></i> Email
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">
                                <i class="fas fa-cog mr-1"></i> Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-50 bg-white">
                        @forelse($students as $student)
                        <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">
                                {{ $student->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $student->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('users.edit', $student) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200 inline-flex items-center gap-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                <i class="fas fa-user-graduate text-4xl text-blue-200 mb-2 block"></i>
                                Belum ada siswa di kelas ini
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($students->hasPages())
        <div class="mt-6">
            {{ $students->links() }}
        </div>
        @endif
    </div>
</x-app-layout>