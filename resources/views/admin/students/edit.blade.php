<x-app-layout>
    <div class="py-6 md:py-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden">
                <div class="px-6 py-5 bg-blue-50 border-b border-blue-100">
                    <h1 class="text-2xl font-bold text-blue-900 flex items-center gap-2">
                        <i class="fas fa-user-edit text-blue-600"></i>
                        Edit Siswa
                    </h1>
                    <p class="text-blue-600 text-sm mt-1">Perbaharui data siswa dan akun user</p>
                </div>

                <div class="p-6">
                    <form action="{{ route('students.update', $student) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-4">
                                <h3 class="font-bold text-blue-800 border-b border-blue-200 pb-1">Data Akun</h3>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $student->user->name) }}" 
                                        class="w-full rounded-xl border-blue-200 focus:border-blue-400 focus:ring-blue-200" required>
                                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', $student->user->email) }}" 
                                        class="w-full rounded-xl border-blue-200 focus:border-blue-400 focus:ring-blue-200" required>
                                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Password <span class="text-gray-500 text-xs">(kosongkan jika tidak diubah)</span></label>
                                    <input type="password" name="password" 
                                        class="w-full rounded-xl border-blue-200 focus:border-blue-400 focus:ring-blue-200">
                                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" 
                                        class="w-full rounded-xl border-blue-200 focus:border-blue-400 focus:ring-blue-200">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h3 class="font-bold text-blue-800 border-b border-blue-200 pb-1">Data Akademik</h3>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">NISN <span class="text-red-500">*</span></label>
                                    <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}" 
                                        class="w-full rounded-xl border-blue-200" required>
                                    @error('nisn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Kelas</label>
                                    <select name="class_id" class="w-full rounded-xl border-blue-200">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach($classrooms as $class)
                                            <option value="{{ $class->id }}" 
                                                {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Tahun Masuk</label>
                                    <input type="number" name="admission_year" value="{{ old('admission_year', $student->admission_year) }}" 
                                        class="w-full rounded-xl border-blue-200">
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="is_active" value="1" 
                                            {{ old('is_active', $student->is_active) ? 'checked' : '' }} 
                                            class="rounded border-blue-300 text-blue-600 focus:ring-blue-200">
                                        <span class="ml-2 text-sm text-slate-700">Aktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 space-y-4">
                            <h3 class="font-bold text-blue-800 border-b border-blue-200 pb-1">Data Pribadi</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Tempat Lahir</label>
                                    <input type="text" name="place_of_birth" value="{{ old('place_of_birth', $student->place_of_birth) }}" 
                                        class="w-full rounded-xl border-blue-200">
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Tanggal Lahir</label>
                                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : '') }}" 
                                        class="w-full rounded-xl border-blue-200">
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Jenis Kelamin</label>
                                    <select name="gender" class="w-full rounded-xl border-blue-200">
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">No. Telepon Siswa</label>
                                    <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" 
                                        class="w-full rounded-xl border-blue-200">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Alamat</label>
                                    <textarea name="address" rows="2" class="w-full rounded-xl border-blue-200">{{ old('address', $student->address) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 space-y-4">
                            <h3 class="font-bold text-blue-800 border-b border-blue-200 pb-1">Data Orang Tua</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Nama Ayah</label>
                                    <input type="text" name="father_name" value="{{ old('father_name', $student->father_name) }}" 
                                        class="w-full rounded-xl border-blue-200">
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Nama Ibu</label>
                                    <input type="text" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}" 
                                        class="w-full rounded-xl border-blue-200">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">No. Telepon Orang Tua</label>
                                    <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}" 
                                        class="w-full rounded-xl border-blue-200">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-6">
                            <a href="{{ route('students.index') }}" 
                                class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">
                                Batal
                            </a>
                            <button type="submit" 
                                class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>