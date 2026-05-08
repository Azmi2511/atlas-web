<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header halaman -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <i class="fas fa-user-circle text-indigo-500 text-4xl"></i>
                    Profil Saya
                </h1>
                <p class="text-gray-600 mt-2">Kelola informasi akun dan kata sandi Anda</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Form Update Profil -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-blue-500 px-6 py-4">
                        <h2 class="text-white font-semibold text-lg flex items-center gap-2">
                            <i class="fas fa-id-card"></i> Informasi Profil
                        </h2>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Form Update Password -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-blue-500 px-6 py-4">
                        <h2 class="text-white font-semibold text-lg flex items-center gap-2">
                            <i class="fas fa-lock"></i> Ubah Kata Sandi
                        </h2>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Hapus Akun (full width) -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-red-500 to-pink-500 px-6 py-4">
                        <h2 class="text-white font-semibold text-lg flex items-center gap-2">
                            <i class="fas fa-trash-alt"></i> Hapus Akun
                        </h2>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <!-- Filosofi footer kecil -->
            <div class="mt-8 text-center text-sm text-gray-500">
                <i class="fas fa-shield-alt text-indigo-400 mr-1"></i> Data Anda aman dan terenkripsi
            </div>
        </div>
    </div>
</x-app-layout>