@extends('layouts.user')

@section('content')
<div class="container mx-auto my-12 px-4 max-w-7xl">
    <!-- Header Section with enhanced spacing and responsive design -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-10 mt-0 rounded-lg">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Daftar Pasar di Yogyakarta</h1>
            <p class="text-xl">Temukan pasar tradisional terbaik di kota Yogyakarta</p>
            
            <!-- Search Bar -->
            <div class="mt-8 max-w-lg mx-auto relative">
                <form action="{{ route('home') }}" method="GET" class="flex">
                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        placeholder="Cari pasar..."
                        value="{{ request('search') }}"
                        class="w-full px-5 py-3 rounded-lg text-gray-800 shadow focus:ring-2 focus:ring-green-500"
                    />
                    <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

        <!-- Market Grid with improved responsive design -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            @foreach($markets as $market)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transform transition duration-300 hover:shadow-xl hover:-translate-y-1"
            id="pasar-{{ $market->id }}">
                <!-- Image Container with aspect ratio -->
                <div class="relative aspect-[4/3]">
                    @if($market->image)
                        <img src="{{ Storage::url($market->image) }}" 
                             alt="{{ $market->name }}"
                             class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/default.jpg') }}" 
                             alt="Default Image"
                             class="absolute inset-0 w-full h-full object-cover">
                    @endif
                    <!-- Optional: Add gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <!-- Content Section with better spacing -->
                <div class="p-6 flex-1 flex flex-col">
                    <a href="{{ route('markets.show', $market) }}" 
                       class="text-gray-900 font-bold text-xl hover:text-gray-700 transition duration-200">
                        Pasar {{ $market->name }}
                    </a>
                    
                    <!-- Location with icon -->
                    <p class="text-gray-600 text-sm mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $market->location }}
                    </p>

                    <p class="text-gray-700 mt-3 text-sm leading-relaxed">
                        {{ Str::limit($market->description, 100, '...') }}
                    </p>
                    

                    <a href="{{ route('markets.show', $market) }}" 
                       class="mt-auto inline-block bg-gray-900 text-white text-center px-4 py-2 rounded-lg shadow hover:bg-gray-800 transition duration-300 ease-in-out text-sm font-medium">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination with improved styling -->
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
@endsection