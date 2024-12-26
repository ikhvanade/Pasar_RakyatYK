<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pengajuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-6">
                        Edit Pengajuan ({{ ucfirst($type) }})
                    </h3>

                    <form action="{{ route('admin.forms.update', ['type' => $type, 'id' => $data->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="nama_lengkap" value="Nama Lengkap" />
                            <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1 block w-full" value="{{ old('nama_lengkap', $data->nama_lengkap) }}" required />
                            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="no_telpon" value="No Telepon" />
                            <x-text-input id="no_telpon" name="no_telpon" type="text" class="mt-1 block w-full" value="{{ old('no_telpon', $data->no_telpon) }}" required />
                            <x-input-error :messages="$errors->get('no_telpon')" class="mt-2" />
                        </div>

                        @if ($type === 'pedagang')
                        <div>
                            <x-input-label for="lokasi_pasar" value="Lokasi Pasar" />
                            <x-text-input id="lokasi_pasar" name="lokasi_pasar" type="text" class="mt-1 block w-full" value="{{ old('lokasi_pasar', $data->lokasi_pasar) }}" required />
                            <x-input-error :messages="$errors->get('lokasi_pasar')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="blok_pasar" value="Blok Pasar" />
                            <x-text-input id="blok_pasar" name="blok_pasar" type="text" class="mt-1 block w-full" value="{{ old('blok_pasar', $data->blok_pasar) }}" />
                            <x-input-error :messages="$errors->get('blok_pasar')" class="mt-2" />
                        </div>
                        @else
                        <div>
                            <x-input-label for="lokasi" value="Lokasi" />
                            <x-text-input id="lokasi" name="lokasi" type="text" class="mt-1 block w-full" value="{{ old('lokasi', $data->lokasi) }}" required />
                            <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                        </div>
                        @endif

                        <div>
                            <x-input-label for="akun_sosmed" value="Akun Sosial Media" />
                            <x-text-input id="akun_sosmed" name="akun_sosmed" type="text" class="mt-1 block w-full" value="{{ old('akun_sosmed', $data->akun_sosmed) }}" />
                            <x-input-error :messages="$errors->get('akun_sosmed')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="permintaan" value="Permintaan" />
                            <textarea id="permintaan" name="permintaan" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" required>{{ old('permintaan', $data->permintaan) }}</textarea>
                            <x-input-error :messages="$errors->get('permintaan')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" value="Status" />
                            <select id="status" name="status" class="mt-1 block h-10 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm" required>
                                <option value="pending" {{ old('status', $data->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $data->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status', $data->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>Simpan Perubahan</x-primary-button>
                            <a href="{{ route('admin.forms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>