<x-app-layout>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden">
                <div class="px-6 py-5 bg-blue-50 border-b border-blue-100">
                    <h1 class="text-2xl font-bold text-blue-900 flex items-center gap-2">
                        <i class="fas fa-user-edit text-blue-600"></i>
                        Edit Pengguna
                    </h1>
                    <p class="text-blue-600 text-sm mt-1">Ubah data pengguna yang sudah terdaftar</p>
                </div>

                <div class="p-6">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label class="block text-blue-800 font-semibold mb-2 text-sm uppercase tracking-wide">
                                <i class="fas fa-user mr-2 text-blue-400"></i> Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                class="w-full rounded-xl border-blue-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200" 
                                placeholder="Masukkan nama lengkap" required>
                            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-blue-800 font-semibold mb-2 text-sm uppercase tracking-wide">
                                <i class="fas fa-envelope mr-2 text-blue-400"></i> Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                class="w-full rounded-xl border-blue-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200" 
                                placeholder="contoh@sekolah.sch.id" required>
                            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-blue-800 font-semibold mb-2 text-sm uppercase tracking-wide">
                                <i class="fas fa-lock mr-2 text-blue-400"></i> Password (kosongkan jika tidak diubah)
                            </label>
                            <input type="password" name="password" 
                                class="w-full rounded-xl border-blue-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200" 
                                placeholder="Minimal 8 karakter">
                            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-5">
                            <label class="block text-blue-800 font-semibold mb-2 text-sm uppercase tracking-wide">
                                <i class="fas fa-check-circle mr-2 text-blue-400"></i> Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation" 
                                class="w-full rounded-xl border-blue-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200" 
                                placeholder="Ulangi password jika diubah">
                        </div>

                        <div class="mb-6">
                            <label class="block text-blue-800 font-semibold mb-2 text-sm uppercase tracking-wide">
                                <i class="fas fa-user-tag mr-2 text-blue-400"></i> Role
                            </label>
                            <select name="role" 
                                class="w-full rounded-xl border-blue-200 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200" 
                                required>
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ in_array($role->name, $userRoles) ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end gap-3 pt-2">
                            <a href="{{ route('users.index') }}" 
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