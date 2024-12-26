<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Pasar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-xl font-bold mb-4">Daftar Pasar</h1>
                    <!-- Tombol Tambah Pasar -->
                    <a href="{{ route('admin.markets.create') }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Tambah Pasar Baru
                    </a>

                    <!-- Tabel Pasar -->
                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-200">No</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Nama Pasar</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Lokasi</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($markets->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-gray-500">Tidak ada pasar yang ditemukan.</td>
                                    </tr>
                                @else
                                    @foreach($markets as $market)
                                        <tr class="border-t border-gray-200 dark:border-gray-600">
                                            <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $market->name }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $market->location }}</td>
                                            <td class="px-4 py-2 text-sm">
                                                <a href="{{ route('admin.markets.show', $market) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat</a>
                                                <a href="{{ route('admin.markets.edit', $market) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                                
                                                <form action="{{ route('admin.markets.destroy', $market) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="confirmDelete(event)">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-12 flex justify-center">
                        <div class="inline-flex items-center rounded-lg bg-white shadow-md">
                            @if ($markets->onFirstPage())
                                <span class="px-4 py-2 text-gray-400 border-r border-gray-200 cursor-not-allowed">
                                    ←
                                </span>
                            @else
                                <a href="{{ $markets->previousPageUrl() }}" 
                                   class="px-4 py-2 text-gray-700 hover:bg-gray-50 border-r border-gray-200 transition duration-200">
                                    ←
                                </a>
                            @endif
            
                            @foreach ($markets->links()->elements as $element)
                                @if (is_string($element))
                                    <span class="px-4 py-2 border-r border-gray-200 text-gray-400">
                                        {{ $element }}
                                    </span>
                                @endif
            
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $markets->currentPage())
                                            <span class="px-4 py-2 bg-gray-900 text-white border-r border-gray-200">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $url }}" 
                                               class="px-4 py-2 text-gray-700 hover:bg-gray-50 border-r border-gray-200 transition duration-200">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
            
                            @if ($markets->hasMorePages())
                                <a href="{{ $markets->nextPageUrl() }}" 
                                   class="px-4 py-2 text-gray-700 hover:bg-gray-50 transition duration-200">
                                    →
                                </a>
                            @else
                                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">
                                    →
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengembalikan data yang dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi di klik, kirim form
                    event.target.closest('form').submit();
                }
            });
        }
    </script>
</x-app-layout>
