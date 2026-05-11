<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
            {{-- Header --}}
            <div class="mb-8 text-center md:text-left">
                <h1 class="text-4xl font-extrabold text-blue-900 tracking-tight">
                    Dashboard {{ $role ?? 'Admin' }}
                </h1>
                <p class="text-blue-700 mt-2 text-lg">
                    Selamat datang, <span
                        class="font-semibold text-blue-600">{{ Auth::user()->name ?? 'Admin' }}</span>.
                    Kelola absensi dengan bijak.
                </p>
                <div class="mt-4 p-4 bg-white/70 backdrop-blur-sm rounded-2xl shadow-sm border-l-8 border-blue-500">
                    <i class="fas fa-quote-left text-blue-400 mr-2"></i>
                    <span class="italic text-gray-700">“Kehadiran bukan sekadar catatan waktu, tetapi cermin komitmen
                        dan penghormatan pada ilmu.”</span>
                    <span class="block text-sm text-blue-600 mt-1">— Filosofi Absensi Digital</span>
                </div>
            </div>

            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-md border-l-8 border-green-500 p-5">
                    <p class="text-gray-500 text-sm uppercase tracking-wide">Hadir Hari Ini</p>
                    <p class="text-3xl font-black text-green-600" id="stat-hadir">{{ $stats['today_hadir'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-md border-l-8 border-yellow-500 p-5">
                    <p class="text-gray-500 text-sm uppercase tracking-wide">Izin</p>
                    <p class="text-3xl font-black text-yellow-600" id="stat-izin">{{ $stats['today_izin'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-md border-l-8 border-blue-500 p-5">
                    <p class="text-gray-500 text-sm uppercase tracking-wide">Sakit</p>
                    <p class="text-3xl font-black text-blue-600" id="stat-sakit">{{ $stats['today_sakit'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-md border-l-8 border-red-500 p-5">
                    <p class="text-gray-500 text-sm uppercase tracking-wide">Alpha</p>
                    <p class="text-3xl font-black text-red-600" id="stat-alpha">{{ $stats['today_alpha'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow-md border-l-8 border-indigo-500 p-5">
                    <p class="text-gray-500 text-sm uppercase tracking-wide">Online</p>
                    <p class="text-3xl font-black text-indigo-600">{{ $stats['online_users'] ?? 0 }}</p>
                </div>
            </div>

            {{-- Grafik Tren --}}
            <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
                <h2 class="text-xl font-bold text-blue-900 mb-4">Tren Kehadiran 7 Hari Terakhir</h2>
                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>

            {{-- Tabel Kehadiran Terbaru --}}
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="px-6 py-4 bg-blue-50 border-b border-blue-100 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-blue-900">Kehadiran Terbaru</h2>
                    <span class="text-xs text-blue-600"><i class="fas fa-circle text-green-500 mr-1"></i> Live</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-blue-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="recent-table" class="divide-y divide-blue-50">
                            @foreach($recentAttendances ?? [] as $att)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $att->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $att->classroom->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $att->check_in_time->format('H:i:s') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @include('components.attendance-badge', ['status' => $att->status])
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('attendance.show', $att) }}"
                                            class="text-blue-600 hover:underline">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Script chart dimulai...');
        const canvas = document.getElementById('attendanceChart');
        if (!canvas) {
            console.error('Canvas tidak ditemukan!');
            return;
        }

        const ctx = canvas.getContext('2d');
        const labels = {!! json_encode($labels ?? []) !!};
        const dataPoints = {!! json_encode($data ?? []) !!};

        console.log('Labels from server:', labels);
        console.log('Data from server:', dataPoints);
        console.log('Chart.js version:', Chart.version);

        if (!labels || labels.length === 0 || !dataPoints || dataPoints.length === 0) {
            console.warn('Data chart kosong! Menggunakan data dummy.');
        }

        const chartData = {
            labels: labels.length > 0 ? labels : ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Hadir',
                data: dataPoints.length > 0 ? dataPoints : [5, 7, 3, 8, 6, 4, 9],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: 'rgb(59, 130, 246)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointHoverRadius: 7
            }]
        };

        try {
            const chart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: Math.max(...(dataPoints.length > 0 ? dataPoints : [10])) + 5
                        }
                    }
                }
            });
            console.log('Chart berhasil dibuat!');
        } catch (e) {
            console.error('Error membuat chart:', e);
        }
    });
</script>