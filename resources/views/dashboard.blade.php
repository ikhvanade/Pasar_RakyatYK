<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grid Layout untuk kotak dashboard -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Kotak untuk Menampilkan Jumlah Pasar -->
                <div class="flex items-center bg-white dark:bg-gray-800 shadow-md rounded-lg w-full h-40 p-6 whitespace-normal text-sm md:text-base">
                    <div class="flex-shrink-0 h-16 w-16 bg-indigo-500 text-white rounded-full flex items-center justify-center">
                        <img src="{{ asset('image/market.png') }}" alt="Market Icon" class="h-10 w-10" />
                    </div>
                    <div class="ml-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 break-words p-2">Jumlah Pasar</h3>
                        <p class="mt-2 text-xl font-bold text-gray-700 dark:text-gray-300 break-words p-2">
                            {{ $marketCount }} Pasar
                        </p>
                    </div>
                </div>

                <!-- Kotak untuk Menampilkan Jumlah Pengajuan Pedagang -->
                <div class="flex items-center bg-white dark:bg-gray-800 shadow-md rounded-lg w-full h-40 p-6 whitespace-normal text-sm md:text-base">
                    <div class="flex-shrink-0 h-16 w-16 bg-green-500 text-white rounded-full flex items-center justify-center">
                        <img src="{{ asset('image/pedagang.png') }}" alt="Pedagang Icon" class="h-10 w-10" />
                    </div>
                    <div class="ml-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 break-words p-2">Jumlah Pengajuan Pedagang</h3>
                        <p class="mt-2 text-xl font-bold text-gray-700 dark:text-gray-300 break-words p-2">
                            {{ $pedagangCount }} Pengajuan
                        </p>
                    </div>
                </div>

                <!-- Kotak untuk Menampilkan Jumlah Pengajuan Umum -->
                <div class="flex items-center bg-white dark:bg-gray-800 shadow-md rounded-lg w-full h-40 p-6 whitespace-normal text-sm md:text-base">
                    <div class="flex-shrink-0 h-16 w-16 bg-yellow-500 text-white rounded-full flex items-center justify-center">
                        <img src="{{ asset('image/umum.png') }}" alt="Umum Icon" class="h-10 w-10" />
                    </div>
                    <div class="ml-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 break-words p-2">Jumlah Pengajuan Umum</h3>
                        <p class="mt-2 text-xl font-bold text-gray-700 dark:text-gray-300 break-words p-2">
                            {{ $umumCount }} Pengajuan
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-8 bg-gray-50 dark:bg-gray-800 shadow-md rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Daftar Pengajuan</h3>
                    <div class ="relative">
                        <select id="submissionTypeFilter" class="form-select bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm p-2">
                            <option value="all">Semua Pengajuan</option>
                            <option value="pedagang">Pengajuan Pedagang</option>
                            <option value="umum">Pengajuan Umum</option>
                        </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse bg-gray-50 dark:bg-gray-800">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                <th class="px-4 py-3 text-left">Nama</th>
                                <th class="px-4 py-3 text-left">No Telepon</th>
                                <th class="px-4 py-3 text-left">Lokasi</th>
                                <th class="px-4 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody id="submissionsTableBody">
                            @foreach($pedagang as $item)
                            <tr class="border-b last:border-none dark:border-gray-700 pedagang-row">
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-300">{{ $item->nama_lengkap }}</td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-300">{{ $item->no_telpon }}</td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-300">Pasar {{ $item->lokasi_pasar }}</td>
                                <td class="px-4 py-3">
                                    <span class="
                                        px-2 py-1 rounded 
                                        @if($item->status == 'pending') bg-yellow-100 text-yellow-800 
                                        @elseif($item->status == 'approved') bg-green-100 text-green-800 
                                        @else bg-red-100 text-red-800 
                                        @endif
                                    ">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            @foreach($umum as $item)
                            <tr class="border-b last:border-none dark:border-gray-700 umum-row">
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-300">{{ $item->nama_lengkap }}</td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-300">{{ $item->no_telpon }}</td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-300">{{ $item->lokasi }}</td>
                                <td class="px-4 py-3">
                                    <span class="
                                        px-2 py-1 rounded 
                                        @if($item->status == 'pending') bg-yellow-100 text-yellow-800 
                                        @elseif($item->status == 'approved') bg-green-100 text-green-800 
                                        @else bg-red-100 text-red-800 
                                        @endif
                                    ">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-8 flex space-x-4">
                <a href="{{ route('export.pedagang') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">Export Data Pedagang</a>
                <a href="{{ route('export.umum') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">Export Data Umum</a>
            </div>

            <!-- Statistik dan Grafik -->
            <div class="mt-8 bg-gray-800 rounded-lg p-6 shadow-lg">
                <!-- Statistik Utama -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-4xl font-bold text-white">{{ $totalSubmissions }}</h3>
                        <p class="text-sm text-gray-400">Total Pengajuan Minggu Ini</p>
                    </div>
                    <div>
                        <span class="{{ $percentageChange >= 0 ? 'text-green-400' : 'text-red-400' }} text-xl font-bold">
                            {{ $percentageChange }}% {{ $percentageChange >= 0 ? '↑' : '↓' }}
                        </span>
                    </div>
                </div>

                <!-- Grafik -->
                <canvas id="submissionChart" class="w-full" height="300"></canvas>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('submissionChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [@foreach(range(1, 12) as $month) "{{ DateTime::createFromFormat('!m', $month)->format('F') }}", @endforeach],
                datasets: [
                    {
                        label: 'Pengajuan Pedagang',
                        data: [@foreach($pedagangData as $data) {{ $data }}, @endforeach],
                        borderColor: 'rgba(59, 130, 246, 1)', // Biru
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        tension: 0.4, // Smooth curve
                        borderWidth: 3,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                        pointHoverRadius: 7,
                    },
                    {
                        label: 'Pengajuan Umum',
                        data: [@foreach($umumData as $data) {{ $data }}, @endforeach],
                        borderColor: 'rgba(234, 179, 8, 1)', // Kuning
                        backgroundColor: 'rgba(234, 179, 8, 0.2)',
                        tension: 0.4, // Smooth curve
                        borderWidth: 3,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(234, 179, 8, 1)',
                        pointHoverRadius: 7,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(107, 114, 128, 0.2)', // Garis grid gelap
                        },
                        ticks: {
                            color: 'rgba(209, 213, 219, 1)', // Warna teks
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(107, 114, 128, 0.2)',
                        },
                        ticks: {
                            color: 'rgba(209, 213, 219, 1)',
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'rgba(209, 213, 219, 1)',
                        }
                    },
                    title: {
                        display: true,
                        text: 'Grafik Pengajuan Bulanan',
                        color: 'rgba(209, 213, 219, 1)',
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
        document.getElementById('submissionTypeFilter').addEventListener('change', function () {
        const rows = document.querySelectorAll('#submissionsTableBody tr');
        const selectedType = this.value;

        rows.forEach(row => {
            // Tampilkan semua jika opsi "all" dipilih
            if (selectedType === 'all') {
                row.style.display = '';
            } else {
                // Filter berdasarkan class row
                if (row.classList.contains(`${selectedType}-row`)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });

    </script>
</x-app-layout>
