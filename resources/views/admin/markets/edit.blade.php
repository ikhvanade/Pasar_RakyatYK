<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Pasar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-6">Edit Data Pasar</h2>

                    <form action="{{ route('admin.markets.update', $market) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Pasar -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium mb-1">Nama Pasar</label>
                            <input type="text" name="name" id="name" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ old('name', $market->name) }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi Pasar -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium mb-1">Deskripsi Pasar</label>
                            <textarea name="description" id="description" rows="4" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('description', $market->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi Pasar -->
                        <div class="mb-6">
                            <label for="location" class="block text-sm font-medium mb-1">Lokasi</label>
                            <input type="text" name="location" id="location" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ old('location', $market->location) }}" required>
                            @error('location')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jam Operasional -->
                        <div class="mb-6">
                            <label for="jam_operasional" class="block text-sm font-medium mb-1">Jam Operasional</label>
                            <input type="text" name="jam_operasional" id="jam_operasional" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ old('jam_operasional', $market->jam_operasional) }}" required>
                            @error('jam_operasional')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="jumlah_pedagang" class="block text-sm font-medium mb-1">Jumlah Pedagang</label>
                            <input type="number" name="jumlah_pedagang" id="jumlah_pedagang" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ old('jumlah_pedagang', $market->jumlah_pedagang) }}" required>
                            @error('jumlah_pedagang')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Grid Layout untuk Kelurahan dan Kecamatan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-6">
                                <label for="kelurahan" class="block text-sm font-medium mb-1">Kelurahan</label>
                                <input type="text" name="kelurahan" id="kelurahan" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ old('kelurahan', $market->kelurahan) }}" required>
                                @error('kelurahan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="kecamatan" class="block text-sm font-medium mb-1">Kecamatan</label>
                                <input type="text" name="kecamatan" id="kecamatan" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ old('kecamatan', $market->kecamatan) }}" required>
                                @error('kecamatan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Grid Layout untuk Luas Tanah dan Luas Bangunan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-6">
                                <label for="luas_tanah" class="block text-sm font-medium mb-1">Luas Tanah</label>
                                <input type="text" name="luas_tanah" id="luas_tanah" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ old('luas_tanah', $market->luas_tanah) }}" required>
                                @error('luas_tanah')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="luas_bangunan" class="block text-sm font-medium mb-1">Luas Bangunan</label>
                                <input type="text" name="luas_bangunan" id="luas_bangunan" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" value="{{ old('luas_bangunan', $market->luas_bangunan) }}" required>
                                @error('luas_bangunan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Gambar Pasar -->
                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium mb-1">Gambar Pasar</label>
                            @if($market->image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($market->image) }}" alt="{{ $market->name }}" class="h-32 w-auto object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar Konten -->
                        <div class="mb-6">
                            <label for="image_content" class="block text-sm font-medium mb-1">Gambar Konten</label>
                            @if($market->image_content)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($market->image_content) }}" alt="{{ $market->name }}" class="h-32 w-auto object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="image_content" id="image_content" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            @error('image_content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="image_tambah" class="block text-sm font-medium mb-1">Gambar Konten Tambahan</label>
                            @if($market->image_tambah)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($market->image_tambah) }}" alt="{{ $market->name }}" class="h-32 w-auto object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="image_tambah" id="image_tambah" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            @error('image_tambah')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-4 space-x-4">
                            <a href="{{ route('admin.markets.index') }}" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md hover:bg-gray-700 dark:hover:bg-white focus:outline-none">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none">Update Pasar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
