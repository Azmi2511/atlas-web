<x-app-layout>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-4">
                <a href="{{ route('students.index') }}" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden">
                <div class="px-6 py-5 bg-blue-50 border-b border-blue-100 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-blue-900">Detail Siswa</h1>
                    @can('manage students')
                    <a href="{{ route('students.edit', $student) }}" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i> Edit</a>
                    @endcan
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-blue-500">NISN</p>
                        <p class="font-semibold">{{ $student->nisn }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">Nama Lengkap</p>
                        <p class="font-semibold">{{ $student->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">Email</p>
                        <p class="font-semibold">{{ $student->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">Kelas</p>
                        <p class="font-semibold">{{ $student->class?->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">Tahun Masuk</p>
                        <p class="font-semibold">{{ $student->admission_year ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">Tempat, Tanggal Lahir</p>
                        <p class="font-semibold">{{ $student->place_of_birth }}, {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d-m-Y') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">Jenis Kelamin</p>
                        <p class="font-semibold">{{ $student->gender == 'L' ? 'Laki-laki' : ($student->gender == 'P' ? 'Perempuan' : '-') }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-blue-500">Alamat</p>
                        <p class="font-semibold">{{ $student->address ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">Nama Ayah</p>
                        <p class="font-semibold">{{ $student->father_name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">Nama Ibu</p>
                        <p class="font-semibold">{{ $student->mother_name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">No. Telepon Siswa</p>
                        <p class="font-semibold">{{ $student->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">No. Telepon Orang Tua</p>
                        <p class="font-semibold">{{ $student->parent_phone ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-500">Status</p>
                        <p class="font-semibold">{{ $student->is_active ? 'Aktif' : 'Nonaktif' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>