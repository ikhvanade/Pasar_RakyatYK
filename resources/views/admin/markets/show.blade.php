<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Data Pasar') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Detail Data Pasar</h2>
                        <a href="{{ route('admin.markets.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Kembali ke Daftar Data Pasar
                        </a>
                    </div>

                    <!-- Main Content Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column: Market Images -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Foto Pasar</h3>
                            <div class="mt-2 space-y-4">
                                @if($market->image)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Gambar Pasar:</p>
                                        <img src="{{ Storage::url($market->image) }}" alt="{{ $market->name }}" class="mt-1 h-48 w-full object-cover rounded-lg">
                                    </div>
                                @endif
                                @if($market->image_content)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Gambar Konten:</p>
                                        <img src="{{ Storage::url($market->image_content) }}" alt="{{ $market->name }}" class="mt-1 h-48 w-full object-cover rounded-lg">
                                    </div>
                                @endif
                                @if($market->image_tambah)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Gambar Konten Tambahan:</p>
                                        <img src="{{ Storage::url($market->image_tambah) }}" alt="{{ $market->name }}" class="mt-1 h-48 w-full object-cover rounded-lg">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right Column: Market Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium">Informasi Pasar</h3>
                            <div class="mt-2 space-y-3">
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Nama Pasar:</span>
                                    <p class="font-medium">{{ $market->name }}</p>
                                </div>
                                
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Deskripsi Pasar:</span>
                                    <p class="font-medium">{{ $market->description }}</p>
                                </div>

                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Lokasi:</span>
                                    <p class="font-medium">{{ $market->location }}</p>
                                </div>

                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Jam Operasional:</span>
                                    <p class="font-medium">{{ $market->jam_operasional }}</p>
                                </div>

                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Jumlah Pedagang:</span>
                                    <p class="font-medium">{{ $market->jumlah_pedagang }}</p>
                                </div>

                                <!-- Kelurahan & Kecamatan dalam satu kolom -->
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Kelurahan & Kecamatan:</span>
                                    <p class="font-medium">{{ $market->kelurahan }} - {{ $market->kecamatan }}</p>
                                </div>

                                <!-- Grid untuk Luas Tanah dan Luas Bangunan di satu baris -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <span class="text-gray-500 dark:text-gray-400">Luas Tanah:</span>
                                        <p class="font-medium">{{ $market->luas_tanah }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 dark:text-gray-400">Luas Bangunan:</span>
                                        <p class="font-medium">{{ $market->luas_bangunan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4 gap-4 mt-6">
                        <a href="{{ route('admin.markets.edit', $market) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Edit Pasar
                        </a>

                        <form action="{{ route('admin.markets.destroy', $market) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to delete this market?')">
                                Hapus Pasar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
