<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Analitik Kehadiran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                 <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                    <p class="font-bold">Terjadi Kesalahan</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Catatan Absensi</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ number_format($stats['total_records']) }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Karyawan</h3>
                        <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ number_format($stats['unique_employees']) }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Absensi Paling Umum</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $stats['top_attendance_type']->attendance_type ?? 'N/A' }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ number_format($stats['top_attendance_type']->total ?? 0) }} kasus</p>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Tipe Kehadiran
                    </h3>
                    
                    @php
                        $barCount = $chartData->count();
                        $dynamicHeight = max(384, $barCount * 35); 
                    @endphp

                    <div class="relative h-96 overflow-y-auto">
                        <div style="height: {{ $dynamicHeight }}px;">
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('attendances.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cari Nama / No. Personal</label>
                                <input type="text" name="search" id="search" placeholder="Ketik di sini..." value="{{ request('search') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label for="attendance_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Kehadiran</label>
                                <select name="attendance_type" id="attendance_type" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Tipe</option>
                                    @foreach ($attendanceTypes as $type)
                                        <option value="{{ $type->attendance_type }}" {{ request('attendance_type') == $type->attendance_type ? 'selected' : '' }}>
                                            {{ $type->attendance_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="filter_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter Tanggal Mulai</label>
                                <input type="date" name="filter_date" id="filter_date" value="{{ request('filter_date') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="flex justify-end items-center mt-4 space-x-3">
                            <a href="{{ route('attendances.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700" title="Reset Filter">
                                Reset
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Daftar Data Kehadiran
                        </h3>
                        <div class="flex space-x-2">
                            <button onclick="document.getElementById('import-modal').classList.remove('hidden')" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 dark:text-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Import Excel</button>
                            <a href="{{ route('attendances.create') }}" class="px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700">+ Data Baru</a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No. Personal</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tipe Kehadiran</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tgl Mulai</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tgl Selesai</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Hari</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($attendances as $index => $attendance)
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $attendances->firstItem() + $index }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $attendance->personal_number }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $attendance->name }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            @if(str_contains(strtolower($attendance->attendance_type), 'mangkir'))
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            @elseif(str_contains(strtolower($attendance->attendance_type), 'cuti'))
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            @endif
                                                {{ $attendance->attendance_type }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $attendance->start_date ? \Carbon\Carbon::parse($attendance->start_date)->format('d M Y') : '-' }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $attendance->end_date ? \Carbon\Carbon::parse($attendance->end_date)->format('d M Y') : '-' }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">{{ $attendance->days }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('attendances.edit',$attendance->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            Data tidak ditemukan. Coba sesuaikan filter atau pencarian Anda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="import-modal" class="hidden fixed z-50 inset-0 overflow-y-auto">
        </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>

    <script>
        Chart.register(ChartDataLabels);

        const chartRawData = @json($chartData);
        const chartLabels = chartRawData.map(item => item.attendance_type);
        const chartValues = chartRawData.map(item => item.total);
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Kasus',
                    data: chartValues,
                    backgroundColor: 'rgba(79, 70, 229, 0.8)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    // === PERUBAHAN UTAMA PADA KONFIGURASI LABEL ===
                    datalabels: {
                        anchor: 'end',
                        // 'end' akan meratakan teks ke KANAN di dalam batang
                        align: 'end',
                        color: '#000000',
                        font: {
                            weight: 'bold',
                        },
                        // offset positif akan memberi jarak dari ujung kanan batang
                        offset: 8, 
                    }
                    // === AKHIR PERUBAHAN ===
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: document.body.classList.contains('dark') ? '#CBD5E1' : '#6B7280'
                        }
                    },
                    y: {
                        ticks: {
                            color: document.body.classList.contains('dark') ? '#CBD5E1' : '#6B7280'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>