<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-left">
            {{ __('Daftar Pengajuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col items-center">
                        <div class="w-full max-w-6xl">
                            <!-- Tabel Pengajuan Pedagang -->
                            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-4 text-center">Pengajuan Pedagang</h2>
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full border-collapse rounded-lg overflow-hidden shadow-lg">
                                    <thead class="bg-gray-200 dark:bg-gray-700">
                                        <tr>
                                            @foreach (['No', 'Email', 'Nama Lengkap', 'No Telepon', 'Lokasi Pasar', 'Blok Pasar', 'Akun Sosial Media', 'Bukti Sosial Media', 'Status', 'Aksi'] as $header)
                                                <th class="border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 px-4 py-2 text-center">{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pedagang->isEmpty())
                                            <tr>
                                                <td colspan="9" class="text-center py-4 text-gray-500 dark:text-gray-400">Belum ada data pengajuan pedagang.</td>
                                            </tr>
                                        @else
                                            @foreach ($pedagang as $item)
                                                <tr class="bg-gray-50 dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->email }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->nama_lengkap }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->no_telpon }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->lokasi_pasar }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->blok_pasar }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->akun_sosmed }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">
                                                        @if ($item->bukti_sosmed)
                                                            <img src="{{ Storage::url($item->bukti_sosmed) }}" alt="Bukti Sosmed" class="w-16 h-16 object-cover rounded">
                                                        @else
                                                            <span class="text-gray-500">Tidak Ada Bukti</span>
                                                        @endif
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">
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
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">
                                                        <div class="flex space-x-2 justify-center">
                                                            <a href="{{ route('admin.forms.show', ['type' => 'pedagang', 'id' => $item->id]) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Detail</a>
                                                            <a href="{{ route('admin.forms.edit', ['type' => 'pedagang', 'id' => $item->id]) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Edit</a>
                                                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.forms.destroy', ['type' => 'pedagang', 'id' => $item->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition" onclick="confirmDelete('{{ $item->id }}')">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tabel Pengajuan Umum -->
                            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mt-8 mb-4 text-center">Pengajuan Umum</h2>
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full border-collapse rounded-lg overflow-hidden shadow-lg">
                                    <thead class="bg-gray-200 dark:bg-gray-700">
                                        <tr>
                                            @foreach (['No', 'Email', 'Nama Lengkap', 'No Telepon', 'Lokasi', 'Akun Sosial Media', 'Bukti Sosial Media', 'Status', 'Aksi'] as $header)
                                                <th class="border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 px-4 py-2 text-center">{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($umum->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">Belum ada data pengajuan umum.</td>
                                            </tr>
                                        @else
                                            @foreach ($umum as $item)
                                                <tr class="bg-gray-50 dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->email }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->nama_lengkap }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->no_telpon }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->lokasi }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">{{ $item->akun_sosmed }}</td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">
                                                        @if ($item->bukti_sosmed)
                                                            <img src="{{ Storage::url($item->bukti_sosmed) }}" alt="Bukti Sosmed" class="w-16 h-16 object-cover rounded">
                                                        @else
                                                            <span class="text-gray-500">Tidak Ada Bukti</span>
                                                        @endif
                                                    </td>
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">
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
                                                    <td class="border border-gray-300 dark:border-gray-600 dark:text-gray-200 px-4 py-2">
                                                        <div class="flex space-x-2 justify-center">
                                                            <a href="{{ route('admin.forms.show', ['type' => 'umum', 'id' => $item->id]) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Detail</a>
                                                            <a href="{{ route('admin.forms.edit', ['type' => 'umum', 'id' => $item->id]) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Edit</a>
                                                            <form id="delete-form-{{ $item->id }}" action="{{ route('admin.forms.destroy', ['type' => 'umum', 'id' => $item->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition" onclick="confirmDelete('{{ $item->id }}')">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                Swal.fire({
                    title: "Terhapus!",
                    text: "Data telah dihapus.",
                    icon: "Sukses"
                }).then(() => {
                    document.getElementById('delete-form-' + id).submit();
                })
            }
            })
        }
    </script>
</x-app-layout>
