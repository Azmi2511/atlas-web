<x-app-layout>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-4">
                <a href="{{ route('teachers.index') }}" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden">
                <div class="px-6 py-5 bg-blue-50 border-b border-blue-100 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-blue-900">Detail Guru</h1>
                    @can('manage teachers')
                    <a href="{{ route('teachers.edit', $teacher) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i> Edit</a>
                    @endcan
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div><p class="text-sm text-blue-500">NIK</p><p class="font-semibold">{{ $teacher->nik ?? '-' }}</p></div>
                    <div><p class="text-sm text-blue-500">NUPTK</p><p class="font-semibold">{{ $teacher->nuptk ?? '-' }}</p></div>
                    <div><p class="text-sm text-blue-500">Nama Lengkap</p><p class="font-semibold">{{ $teacher->user->name }}</p></div>
                    <div><p class="text-sm text-blue-500">Email</p><p class="font-semibold">{{ $teacher->user->email }}</p></div>
                    <div><p class="text-sm text-blue-500">Mata Pelajaran</p><p class="font-semibold">{{ $teacher->subject_specialization ?? '-' }}</p></div>
                    <div><p class="text-sm text-blue-500">Pendidikan</p><p class="font-semibold">{{ $teacher->education ?? '-' }}</p></div>
                    <div><p class="text-sm text-blue-500">Tempat, Tanggal Lahir</p><p class="font-semibold">{{ $teacher->place_of_birth }}, {{ $teacher->date_of_birth ? \Carbon\Carbon::parse($teacher->date_of_birth)->format('d-m-Y') : '-' }}</p></div>
                    <div><p class="text-sm text-blue-500">Jenis Kelamin</p><p class="font-semibold">{{ $teacher->gender == 'L' ? 'Laki-laki' : ($teacher->gender == 'P' ? 'Perempuan' : '-') }}</p></div>
                    <div><p class="text-sm text-blue-500">No. Telepon</p><p class="font-semibold">{{ $teacher->phone ?? '-' }}</p></div>
                    <div><p class="text-sm text-blue-500">Tanggal Masuk</p><p class="font-semibold">{{ $teacher->hire_date ? \Carbon\Carbon::parse($teacher->hire_date)->format('d-m-Y') : '-' }}</p></div>
                    <div class="md:col-span-2"><p class="text-sm text-blue-500">Alamat</p><p class="font-semibold">{{ $teacher->address ?? '-' }}</p></div>
                    <div><p class="text-sm text-blue-500">Status</p><p class="font-semibold">{{ $teacher->is_active ? 'Aktif' : 'Nonaktif' }}</p></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>