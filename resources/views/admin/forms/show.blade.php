<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pengajuan') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">
                    Detail Pengajuan ({{ ucfirst($type) }})
                </h1>
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</p>
                        <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $data->nama_lengkap }}</p>
                    </div>
    
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">No Telepon</p>
                        <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $data->no_telpon }}</p>
                    </div>
    
                    @if ($type === 'pedagang')
                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi Pasar</p>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $data->lokasi_pasar }}</p>
                        </div>
    
                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Blok Pasar</p>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $data->blok_pasar }}</p>
                        </div>
                    @else
                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi</p>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $data->lokasi }}</p>
                        </div>
                    @endif
    
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Akun Sosial Media</p>
                        <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $data->akun_sosmed }}</p>
                    </div>
    
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Bukti Sosial Media</p>
                        <p class="mt-1">
                            @if ($data->bukti_sosmed)
                                <a href="{{ Storage::url($data->bukti_sosmed) }}" 
                                   class="text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300" 
                                   target="_blank" 
                                   download>
                                    Download Bukti
                                </a>
                            @else
                                <span class="text-gray-900 dark:text-gray-100">Tidak Ada Bukti</span>
                            @endif
                        </p>
                    </div>
                    
    
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Permintaan</p>
                        <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $data->permintaan }}</p>
                    </div>
    
                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Status</p>
                        <p class="mt-1 text-gray-900 dark:text-gray-100">{{ ucfirst($data->status) }}</p>
                    </div>
                </div>
    
                <div>
                    <a href="{{ route('admin.forms.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
