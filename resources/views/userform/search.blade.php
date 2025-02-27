@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-center text-2xl font-bold text-gray-800 mb-8">
        Temukan Pengajuan Anda dengan Mudah!
    </h1>
    
    <div class="flex items-center justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Cari Pengajuan Anda</h2>
            <p class="text-gray-600 mb-6">
                Ingin tahu perkembangan pengajuan Anda? Halaman ini membantu Anda untuk melacak status pengajuan secara praktis dan efisien.
            </p>
            <form action="{{ route('userform.search') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Masukkan email Anda" 
                        required 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                </div>
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Cari Pengajuan
                    </button>
                    <div class="mt-6 text-center">
                        <a href="{{ url('/userform/form') }}" class="inline-block bg-blue-800 text-white py-2 px-4 rounded-md shadow hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection