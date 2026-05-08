<x-app-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-4xl font-extrabold text-blue-900 tracking-tight">
                Dashboard {{ $role }}
            </h1>
            <p class="text-blue-700 mt-2 text-lg">
                Selamat datang, <span class="font-semibold text-blue-600">{{ Auth::user()->name ?? 'Admin' }}</span>.
                Kelola absensi dengan bijak.
            </p>
            <div class="mt-4 p-4 bg-white/70 backdrop-blur-sm rounded-2xl shadow-sm border-l-8 border-blue-500">
                <i class="fas fa-quote-left text-blue-400 mr-2"></i>
                <span class="italic text-gray-700">“Kehadiran bukan sekadar catatan waktu, tetapi cermin komitmen dan penghormatan pada ilmu.”</span>
                <span class="block text-sm text-blue-600 mt-1">— Filosofi Absensi Digital</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @can('manage all users')
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-500 text-sm uppercase tracking-wide">Total Pengguna</p>
                            <p class="text-4xl font-black text-blue-900 mt-2">{{ number_format($totalUsers) }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-users text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 w-full bg-blue-100 rounded-full h-1.5">
                        <div class="bg-blue-500 h-1.5 rounded-full w-full transition-all duration-1000"></div>
                    </div>
                    <p class="text-xs text-blue-400 mt-3"><i class="fas fa-user-plus mr-1"></i> Seluruh pengguna terdaftar</p>
                </div>
            </div>
            @endcan

            @can('view class attendance')
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-500 text-sm uppercase tracking-wide">Kehadiran Hari Ini</p>
                            <p class="text-4xl font-black text-blue-900 mt-2">{{ number_format($todayAttendance) }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-calendar-check text-green-600 text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 w-full bg-blue-100 rounded-full h-1.5">
                        <div class="bg-green-500 h-1.5 rounded-full transition-all duration-1000" style="width: {{ $todayPercent }}%"></div>
                    </div>
                    <p class="text-xs text-blue-400 mt-3">
                        <i class="fas fa-chart-line mr-1"></i> {{ number_format($todayPercent, 1) }}% dari total pengguna
                    </p>
                </div>
            </div>

            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-500 text-sm uppercase tracking-wide">Kehadiran Bulan Ini</p>
                            <p class="text-4xl font-black text-blue-900 mt-2">{{ number_format($monthlyAttendance) }}</p>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fas fa-chart-simple text-yellow-600 text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 w-full bg-blue-100 rounded-full h-1.5">
                        <div class="bg-yellow-500 h-1.5 rounded-full transition-all duration-1000" style="width: {{ $monthlyPercent }}%"></div>
                    </div>
                    <p class="text-xs text-blue-400 mt-3">
                        <i class="fas fa-calendar-alt mr-1"></i> {{ now()->format('F Y') }} — {{ number_format($monthlyPercent, 1) }}% tingkat kehadiran
                    </p>
                </div>
            </div>
            @endcan
        </div>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-clock text-blue-500 text-2xl"></i>
                <h3 class="font-semibold text-blue-900 mt-1">Tepat Waktu</h3>
                <p class="text-sm text-blue-700">Menghargai waktu orang lain</p>
            </div>
            <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-fingerprint text-blue-500 text-2xl"></i>
                <h3 class="font-semibold text-blue-900 mt-1">Akuntabel</h3>
                <p class="text-sm text-blue-700">Setiap kehadiran tercatat otentik</p>
            </div>
            <div class="bg-white/60 backdrop-blur-sm p-4 rounded-xl">
                <i class="fas fa-graduation-cap text-blue-500 text-2xl"></i>
                <h3 class="font-semibold text-blue-900 mt-1">Berkarakter</h3>
                <p class="text-sm text-blue-700">Disiplin membangun prestasi</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const progressBars = document.querySelectorAll('.rounded-full.bg-green-500, .rounded-full.bg-blue-500, .rounded-full.bg-yellow-500');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 200);
        });
    });
</script>
</x-app-layout>