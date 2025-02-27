@extends('layouts.user')

@section('content')
<div class="container mx-auto my-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">Pasar {{ $market->name }}</h1>

        @if($market->image_content)
        <div class="flex justify-center mb-8">
            <img src="{{ Storage::url($market->image_content) }}" 
                 alt="{{ $market->name }}" 
                 class="w-full max-w-md h-64 rounded-lg object-cover shadow-md">
        </div>
        @endif

        <div class="text-gray-700 space-y-4">
            <p class="text-lg leading-relaxed text-left" style="text-indent: 2em; text-align: justify;">{{ $market->description }}</p>
            
            <div class="bg-white rounded-lg shadow-md p-6 border">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Informasi Pasar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg p-4 border shadow-sm">
                        <h3 class="font-semibold text-lg mb-3 text-gray-700">Lokasi</h3>
                        <div class="space-y-2">
                            <p><span class="font-semibold">Alamat:</span> {{ $market->location }}</p>
                            <p><span class="font-semibold">Kelurahan:</span> {{ $market->kelurahan }}</p>
                            <p><span class="font-semibold">Kecamatan:</span> {{ $market->kecamatan }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-4 border shadow-sm">
                        <h3 class="font-semibold text-lg mb-3 text-gray-700">Detail Pasar</h3>
                        <div class="space-y-2">
                            @if($market->jam_operasional)
                                <p><span class="font-semibold">Jam Operasional:</span> {{ $market->jam_operasional }}</p>
                            @endif
                            @if($market->jumlah_pedagang)
                                <p><span class="font-semibold">Jumlah Pedagang:</span> {{ $market->jumlah_pedagang }}</p>
                            @endif
                            @if($market->luas_tanah)
                                <p><span class="font-semibold">Luas Tanah:</span> {{ $market->luas_tanah }} m²</p>
                            @endif
                            @if($market->luas_bangunan)
                                <p><span class="font-semibold">Luas Bangunan:</span> {{ $market->luas_bangunan }} m²</p>
                            @endif
                        </div>
                    </div>
                </div>
        
                <div class="mt-6 bg-white rounded-lg p-4 border shadow-sm">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700">Layout Pasar</h3>
                    @if($market->image_tambah)
                        <div class="flex justify-center">
                            <img src="{{ Storage::url($market->image_tambah) }}" 
                                 alt="{{ $market->name }}" 
                                 class="w-full max-w-md h-64 rounded-lg object-cover shadow-md">
                        </div>
                    @else
                        <p class="text-gray-500 italic">Layout pasar tidak tersedia</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
