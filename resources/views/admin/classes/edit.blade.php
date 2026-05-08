<x-app-layout>
    <div class="py-6 md:py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden">
                <div class="px-6 py-5 bg-blue-50 border-b border-blue-100">
                    <h1 class="text-2xl font-bold text-blue-900 flex items-center gap-2">
                        <i class="fas fa-edit text-blue-600"></i>
                        Edit Kelas
                    </h1>
                    <p class="text-blue-600 text-sm mt-1">Ubah data kelas yang sudah terdaftar</p>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('classes.update', $class) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label class="block text-blue-800 font-semibold mb-2 text-sm uppercase tracking-wide">
                                <i class="fas fa-tag mr-2 text-blue-400"></i> Nama Kelas <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $class->name) }}" 
                                class="w-full rounded-xl border-blue-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200" 
                                placeholder="Contoh: XII IPA 1" required>
                            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-blue-800 font-semibold mb-2 text-sm uppercase tracking-wide">
                                <i class="fas fa-layer-group mr-2 text-blue-400"></i> Tingkat
                            </label>
                            <select name="grade" class="w-full rounded-xl border-blue-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200">
                                <option value="">Pilih Tingkat</option>
                                <option value="10" {{ old('grade', $class->grade) == '10' ? 'selected' : '' }}>10 (Kelas X)</option>
                                <option value="11" {{ old('grade', $class->grade) == '11' ? 'selected' : '' }}>11 (Kelas XI)</option>
                                <option value="12" {{ old('grade', $class->grade) == '12' ? 'selected' : '' }}>12 (Kelas XII)</option>
                            </select>
                            @error('grade') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-blue-800 font-semibold mb-2 text-sm uppercase tracking-wide">
                                <i class="fas fa-chalkboard-user mr-2 text-blue-400"></i> Wali Kelas
                            </label>
                            <select name="teacher_id" class="w-full rounded-xl border-blue-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200">
                                <option value="">-- Pilih Guru --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $class->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-blue-800 font-semibold mb-2 text-sm uppercase tracking-wide">
                                <i class="fas fa-calendar-alt mr-2 text-blue-400"></i> Tahun Ajaran
                            </label>
                            <input type="text" name="academic_year" value="{{ old('academic_year', $class->academic_year) }}" 
                                class="w-full rounded-xl border-blue-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200" 
                                placeholder="Contoh: 2024/2025">
                            @error('academic_year') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <a href="{{ route('classes.index') }}" 
                                class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition duration-200 flex items-center gap-2">
                                <i class="fas fa-arrow-left"></i> Batal
                            </a>
                            <button type="submit" 
                                class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md transition duration-200 flex items-center gap-2">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>