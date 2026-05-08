<x-app-layout>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden">
                <div class="px-6 py-5 bg-blue-50 border-b border-blue-100">
                    <h1 class="text-2xl font-bold text-blue-900 flex items-center gap-2">
                        <i class="fas fa-user-plus text-blue-600"></i>
                        Tambah Guru Baru
                    </h1>
                    <p class="text-blue-600 text-sm mt-1">Lengkapi data guru dan akun user</p>
                </div>

                <div class="p-6">
                    <form action="{{ route('teachers.update', $teacher) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-4">
                                <h3 class="font-bold text-blue-800 border-b border-blue-200 pb-1">Data Akun</h3>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $teacher->user->name) }}" class="w-full rounded-xl border-blue-200" required>
                                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('name', $teacher->user->name) }}" class="w-full rounded-xl border-blue-200" required>
                                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label>Password <span class="text-gray-500 text-xs">(kosongkan jika tidak diubah)</span></label>
                                    <input type="password" name="password" class="w-full rounded-xl border-blue-200">
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="w-full rounded-xl border-blue-200">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h3 class="font-bold text-blue-800 border-b border-blue-200 pb-1">Data Profesi</h3>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">NIK</label>
                                    <input type="text" name="nik" value="{{ old('nik') }}" class="w-full rounded-xl border-blue-200">
                                    @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">NUPTK</label>
                                    <input type="text" name="nuptk" value="{{ old('nuptk') }}" class="w-full rounded-xl border-blue-200">
                                    @error('nuptk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Mata Pelajaran</label>
                                    <input type="text" name="subject_specialization" value="{{ old('subject_specialization') }}" class="w-full rounded-xl border-blue-200">
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Pendidikan Terakhir</label>
                                    <select name="education" class="w-full rounded-xl border-blue-200">
                                        <option value="">-- Pilih --</option>
                                        <option value="S1" {{ old('education') == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('education') == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('education') == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Tanggal Masuk</label>
                                    <input type="date" name="hire_date" value="{{ old('hire_date') }}" class="w-full rounded-xl border-blue-200">
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-blue-300 text-blue-600">
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
                                    <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" class="w-full rounded-xl border-blue-200">
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Tanggal Lahir</label>
                                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full rounded-xl border-blue-200">
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Jenis Kelamin</label>
                                    <select name="gender" class="w-full rounded-xl border-blue-200">
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">No. Telepon</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-xl border-blue-200">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-blue-800 font-semibold mb-1 text-sm">Alamat</label>
                                    <textarea name="address" rows="2" class="w-full rounded-xl border-blue-200">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-6">
                            <a href="{{ route('teachers.index') }}" class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">Batal</a>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>