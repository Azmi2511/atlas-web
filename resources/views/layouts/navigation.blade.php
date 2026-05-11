<nav x-data="{ open: false }" class="h-full flex flex-col bg-transparent">
    <div class="flex-1 px-5 py-6 overflow-y-auto">
        <div class="mb-8">
            <p class="text-xs uppercase tracking-[0.2em] text-blue-300 mb-4 px-3">
                Menu Utama
            </p>

            <div class="space-y-2">
                <!-- Dashboard -->
                <x-nav-link 
                    :href="route('dashboard')" 
                    :active="request()->routeIs('dashboard')"
                    class="group flex items-center gap-4 rounded-2xl px-4 py-3 transition-all duration-300"
                >
                    <div class="h-11 w-11 rounded-xl flex items-center justify-center bg-blue-800 group-[.active]:bg-blue-600 transition-all duration-300">
                        <i class="fas fa-chart-line text-sm text-white"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold text-sm text-white">Dashboard</span>
                        <span class="text-xs text-blue-300">Monitoring Sistem</span>
                    </div>
                </x-nav-link>

                @can('manage all users')
                    <!-- Pengguna -->
                    <x-nav-link 
                        :href="route('users.index')" 
                        :active="request()->routeIs('users.*')"
                        class="group flex items-center gap-4 rounded-2xl px-4 py-3 transition-all duration-300"
                    >
                        <div class="h-11 w-11 rounded-xl flex items-center justify-center bg-blue-800 group-[.active]:bg-blue-600 transition-all duration-300">
                            <i class="fas fa-users text-sm text-white"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-white">Pengguna</span>
                            <span class="text-xs text-blue-300">Manajemen Pengguna</span>
                        </div>
                    </x-nav-link>

                    <!-- Kelas -->
                    <x-nav-link 
                        :href="route('classes.index')" 
                        :active="request()->routeIs('classes.*')"
                        class="group flex items-center gap-4 rounded-2xl px-4 py-3 transition-all duration-300"
                    >
                        <div class="h-11 w-11 rounded-xl flex items-center justify-center bg-blue-800 group-[.active]:bg-blue-600 transition-all duration-300">
                            <i class="fas fa-school text-sm text-white"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-white">Kelas</span>
                            <span class="text-xs text-blue-300">Data Kelas</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link 
                        :href="route('teachers.index')" 
                        :active="request()->routeIs('teachers.*')"
                        class="group flex items-center gap-4 rounded-2xl px-4 py-3 transition-all duration-300"
                    >
                        <div class="h-11 w-11 rounded-xl flex items-center justify-center bg-blue-800 group-[.active]:bg-blue-600 transition-all duration-300">
                            <i class="fas fa-school text-sm text-white"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-white">Guru</span>
                            <span class="text-xs text-blue-300">Data Guru</span>
                        </div>
                    </x-nav-link>
                @endcan

                @can('view students')
                    <!-- Siswa -->
                    <x-nav-link 
                        :href="route('students.index')" 
                        :active="request()->routeIs('students.*')" 
                        class="group flex items-center gap-4 rounded-2xl px-4 py-3 transition-all duration-300"
                    >
                        <div class="h-11 w-11 rounded-xl flex items-center justify-center bg-blue-800 group-[.active]:bg-blue-600 transition-all duration-300"> 
                            <i class="fas fa-user-graduate text-sm text-white"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-white">Siswa</span>
                            <span class="text-xs text-blue-300">Data Siswa</span>
                        </div>
                    </x-nav-link>
                    <x-nav-link 
                        :href="route('attendance.index')" 
                        :active="request()->routeIs('attendance.*')" 
                        class="group flex items-center gap-4 rounded-2xl px-4 py-3 transition-all duration-300"
                    >
                        <div class="h-11 w-11 rounded-xl flex items-center justify-center bg-blue-800 group-[.active]:bg-blue-600 transition-all duration-300"> 
                            <i class="fas fa-user-check text-sm text-white"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-white">Absensi</span>
                            <span class="text-xs text-blue-300">Data Absensi</span>
                        </div>
                    </x-nav-link>
                @endcan
            </div>
        </div>
    </div>
</nav>