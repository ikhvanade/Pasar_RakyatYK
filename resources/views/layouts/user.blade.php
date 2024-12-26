<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pasar Rakyat - Yogyakarta' }}</title>

    <!-- Tambahkan favicon -->
    <link rel="icon" href="{{ asset('image/disdag.png') }}" type="image/x-icon"/>

    <!-- Memuat Tailwind CSS melalui Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite('resources/css/app.css')
</head>

<style>
    .header-container {
        height: 5rem; /* Tinggi tetap untuk header */
        display: flex;
        align-items: center; /* Logo tetap sejajar vertikal */
        overflow: hidden; /* Mencegah elemen lain memengaruhi tinggi */
    }

    .logo-large {
        height: 7rem; /* Ukuran besar untuk logo */
        object-fit: contain;
        margin-top: -1rem; /* Logo terlihat lebih besar dengan bagian atas sedikit keluar */
    }
</style>




<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-white text-black shadow-md sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center header-container">
            <!-- Logo dan Judul -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('image/disdag.png') }}" 
                     alt="Dinas Perdagangan"
                     class="logo-large w-auto">
            </a>
            <!-- Menu Navigasi -->
            <div class="space-x-6 hidden sm:flex">
                <a href="{{ route('userform.form') }}"
                class="{{ Route::currentRouteName() === 'userform.form' ? 'text-blue-800 font-medium border-b-2 border-blue-800' : 'text-blue-600 hover:text-blue-800 font-medium' }}">
                    Form Pengajuan
                </a>
                <a href="{{ route('userform.search') }}"
                class="{{ Route::currentRouteName() === 'userform.search' ? 'text-blue-800 font-medium border-b-2 border-blue-800' : 'text-blue-600 hover:text-blue-800 font-medium' }}">
                    Lihat Pengajuan
                </a>
                <a href="{{ route('home') }}"
                class="{{ Route::currentRouteName() === 'home' ? 'text-blue-800 font-medium border-b-2 border-blue-800' : 'text-blue-600 hover:text-blue-800 font-medium' }}">
                    Beranda
                </a>
            </div>

            <!-- Tombol Menu untuk Mobile -->
            <button class="sm:hidden flex items-center text-gray-500 focus:outline-none" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </nav>

        <!-- Menu Dropdown Mobile -->
        <div class="sm:hidden" id="mobile-menu" style="display: none;">
            <div class="space-y-4 py-4 px-4 bg-white shadow-md">
                <div class="w-fit">
                    <a href="{{ route('userform.form') }}"
                    class="{{ Route::currentRouteName() === 'userform.form' ? 'block text-blue-800 font-medium border-b-2 border-blue-800' : 'block text-blue-600 hover:text-blue-800 font-medium' }}">
                        Form Pengajuan
                    </a>
                </div>
                <div class="w-fit">
                    <a href="{{ route('userform.search') }}"
                    class="{{ Route::currentRouteName() === 'userform.search' ? 'block text-blue-800 font-medium border-b-2 border-blue-800' : 'block text-blue-600 hover:text-blue-800 font-medium' }}">
                        Lihat Pengajuan
                    </a>
                </div>
                <div class="w-fit">
                    <a href="{{ route('home') }}"
                    class="{{ Route::currentRouteName() === 'home' ? 'block text-blue-800 font-medium border-b-2 border-blue-800' : 'block text-blue-600 hover:text-blue-800 font-medium' }}">
                        Beranda
                    </a>
                </div>
            </div>
        </div>

    </header>
    <script>
        // Script untuk Toggle Menu Mobile
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
    
        mobileMenuButton.addEventListener('click', () => {
            if (mobileMenu.style.display === 'none' || !mobileMenu.style.display) {
                mobileMenu.style.display = 'block';
            } else {
                mobileMenu.style.display = 'none';
            }
        });
    </script>
    

    <!-- Main Content -->
    <main class="flex-1">
        <div class="container mx-auto px-4 py-8">
            @yield('content')
        </div>
    </main>

    <footer class="bg-gradient-to-r from-slate-800 via-slate-600 to-slate-700 text-white">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:px-24"> <!-- Menambahkan padding horizontal -->
                <!-- Kolom Hubungi Kami -->
                <div class="lg:text-left lg:pl-10"> <!-- Menambahkan padding left -->
                    <h3 class="text-xl font-semibold mb-6">Hubungi Kami</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12c0 1.73.44 3.36 1.21 4.79L2 22l5.21-1.21C8.64 21.56 10.27 22 12 22c5.52 0 10-4.48 10-10s-4.48-10-10-10zm.6 17.2c-1.54-.03-2.7-.3-4.05-.9-.78-.35-1.57-.82-2.14-1.47l-.38-.38a.99.99 0 01.27-1.56c.29-.17.61-.2.9-.13l.1.03c.19.07.37.21.6.42.12.11.22.22.32.34.44.48.87.77 1.34 1.07.46.3.98.6 1.6.8.32.1.7.24 1.09.29.64.08 1.1-.12 1.63-.6.4-.38.72-.8 1.01-1.21.3-.43.46-.84.74-1.4.28-.55.67-1.11 1.26-1.4.49-.23 1.01-.21 1.41.03.18.11.34.26.45.4.29.34.55.72.72 1.08.21.44.21.92-.01 1.36-.37.74-1 1.5-1.56 2.17-.61.73-1.22 1.29-1.92 1.79-.62.45-1.21.8-1.96.8-.47.02-.96.02-1.48-.07z"/>
                            </svg>
                            <span class="text-base">(+62)87862316289</span>
                        </div>                        
                        <div class="flex items-center space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-base">disdagkotayk@gmail.com</span>
                        </div>
                        <div class="flex items-start space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-base">Jalan Pabringan No. 1 Ngupasan, Gondomanan, Kota Yogyakarta Kode Pos 55122</span>
                        </div>
                    </div>
                </div>
    
                <!-- Kolom Jam Operasional -->
                <div class="lg:text-left lg:pl-10"> <!-- Menambahkan padding left -->
                    <h3 class="text-xl font-semibold mb-6">Jam Operasional</h3>
                    <div class="flex items-start space-x-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="space-y-2">
                            <p class="text-base">Senin - Jumat: 08.00 - 15.30</p>
                            <p class="text-base">Sabtu: Tutup</p>
                            <p class="text-base">Minggu: Tutup</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="border-t border-white/20 mt-12 pt-8 text-center">
                <p class="text-sm text-gray-300">Dinas Perdagangan Kota Yogyakarta &copy; {{ date('Y') }} All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
