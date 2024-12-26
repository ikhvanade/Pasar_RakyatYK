@extends('layouts.user')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .select2-container--default .select2-selection--single {
            height: 42px;
            padding: 6px;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
        }
        .select2-dropdown {
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
        }
        </style>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }
        </style>
    
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-4xl font-extrabold mb-6 text-center text-slate-800">
            Form Layanan Media Digital Pasar Rakyat Kota Yogyakarta
        </h2>
        <h3 class="text-xl font-semibold mb-4 mt-6 text-gray-600">
            Pilih Jenis Formulir
        </h3>

        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex space-x-4 mb-6">
            <p class="text-red-500">*Klik Untuk Memilih</p>
        </div>
        <!-- Tombol Pilihan -->
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-6">
            <button id="btn-pedagang" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Form Pedagang</button>
            <button id="btn-umum" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-200">Form Umum</button>
            <!-- Tombol Pencarian -->
            <a href="{{ route('userform.search') }}" class="bg-purple-500 text-white px-4 py-2 rounded block text-center hover:bg-purple-600 transition duration-200">
                Cari Pengajuan Saya
            </a>
        </div>

        <!-- Form Pedagang -->
        <div id="form-pedagang" class="hidden">
            <h2 class="text-xl font-semibold mb-2">Formulir Pengajuan Pedagang</h2>
            <form action="{{ route('userform.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="form_type" value="pedagang">
                <div>
                    <label for="nama_lengkap" class="block">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="email" class="block">Email</label>
                    <input type="text" name="email" id="email" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="no_telpon" class="block">No Telepon (Whatsapp)</label>
                    <input type="text" name="no_telpon" id="no_telpon" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="lokasi_pasar" class="block mb-2">Lokasi Pasar</label>
                    <select id="lokasi_pasar" name="lokasi_pasar" class="w-full border border-gray-300 rounded p-2" required>
                        <option value="" disabled selected>Pilih lokasi pasar...</option>
                        <option value="beringharjo">Beringharjo</option>
                        <option value="pasty">PASTY</option>
                        <option value="terban">Terban</option>
                        <option value="telo-karangkajen">Telo Karangkajen</option>
                        <option value="demangan">Demangan</option>
                        <option value="giwangan">Giwangan</option>
                        <option value="ngasem">Ngasem</option>
                        <option value="kranggan">Kranggan</option>
                        <option value="lempuyangan">Lempuyangan</option>
                        <option value="kotagede">Kotagede</option>
                        <option value="gedongkuning">Gedongkuning</option>
                        <option value="sentul">Sentul</option>
                        <option value="prawirotaman">Prawirotaman</option>
                        <option value="pathuk">Pathuk</option>
                        <option value="karangwaru">Karangwaru</option>
                        <option value="serangan">Serangan</option>
                        <option value="sanggrahan">Sanggrahan</option>
                        <option value="pingit">Pingit</option>
                        <option value="gading">Gading</option>
                        <option value="colombo">Colombo</option>
                        <option value="talok">Talok</option>
                        <option value="rejowinangun">Rejowinangun</option>
                        <option value="senen">Senen</option>
                        <option value="pujokusuman">Pujokusuman</option>
                        <option value="suryobrantan">Suryobrantan</option>
                        <option value="cokrokembang">Cokrokembang</option>
                        <option value="klitren">Klitren</option>
                        <option value="gondomanan">Gondomanan</option>
                        <option value="semaki">Semaki</option>
                    </select>
                </div>
                <div>
                    <label for="blok_pasar" class="block">Blok Pasar</label>
                    <input type="text" name="blok_pasar" id="blok_pasar" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="akun_sosmed" class="block">Akun Sosial Media</label>
                    <input type="text" name="akun_sosmed" id="akun_sosmed" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="bukti_sosmed" class="block">Bukti Sosial Media</label>
                    <input type="file" name="bukti_sosmed" id="bukti_sosmed" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="permintaan" class="block">Permintaan</label>
                    <textarea name="permintaan" id="permintaan" class="w-full border border-gray-300 rounded p-2" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                    <svg class="animate-spin h-5 w-5 mr-2 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    Ajukan
                  </button>                  
            </form>
        </div>

        <!-- Form Umum -->
        <div id="form-umum" class="hidden">
            <h2 class="text-xl font-semibold mb-2">Formulir Pengajuan Umum</h2>
            <form action="{{ route('userform.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="form_type" value="umum">
                <div>
                    <label for="nama_lengkap" class="block">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="email" class="block">Email</label>
                    <input type="text" name="email" id="email" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="no_telpon" class="block">No Telepon (Whatsapp)</label>
                    <input type="text" name="no_telpon" id="no_telpon" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="lokasi" class="block">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="akun_sosmed" class="block">Akun Sosial Media</label>
                    <input type="text" name="akun_sosmed" id="akun_sosmed" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="bukti_sosmed" class="block">Bukti Sosial Media</label>
                    <input type="file" name="bukti_sosmed" id="bukti_sosmed" class="w-full border border-gray-300 rounded p-2" required>
                </div>
                <div>
                    <label for="permintaan" class="block">Permintaan</label>
                    <textarea name="permintaan" id="permintaan" class="w-full border border-gray-300 rounded p-2" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                    <svg class="animate-spin h-5 w-5 mr-2 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    Ajukan
                  </button>  
            </form>
        </div>
    </div>

    <script>
        // Tampilkan form Pedagang dan sembunyikan form Umum
        document.getElementById('btn-pedagang').addEventListener('click', function () {
            document.getElementById('form-pedagang').classList.remove('hidden');
            document.getElementById('form-umum').classList.add('hidden');
        });
    
        // Tampilkan form Umum dan sembunyikan form Pedagang
        document.getElementById('btn-umum').addEventListener('click', function () {
            document.getElementById('form-pedagang').classList.add('hidden');
            document.getElementById('form-umum').classList.remove('hidden');
        });
    
        $(document).ready(function() {
        $('#lokasi_pasar').select2({
                placeholder: 'Pilih lokasi pasar...',
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Pasar tidak ditemukan";
                    }
                }
            });
        });
    
        // Tambahkan event listener untuk setiap form
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah submit default
    
                const spinner = this.querySelector('svg');
                spinner.classList.remove('hidden'); // Tampilkan spinner
    
                const formData = new FormData(this);
    
                // Kirim data form dengan fetch
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        spinner.classList.add('hidden'); // Sembunyikan spinner
    
                        if (data.message) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                form.reset(); // Reset form setelah sukses
                                document.getElementById('form-pedagang').classList.add('hidden');
                                document.getElementById('form-umum').classList.add('hidden');
                            });
                        } else if (data.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.error,
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        spinner.classList.add('hidden'); // Sembunyikan spinner jika error
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: 'Terjadi kesalahan saat mengirim form.',
                            confirmButtonText: 'OK'
                        });
                    });
    
                // Validasi form input
                const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
                inputs.forEach(input => {
                    input.addEventListener('input', function () {
                        if (this.value.trim()) {
                            this.classList.remove('border-red-500');
                        }
                    });
                });
            });
        });
    </script>
    
@endsection