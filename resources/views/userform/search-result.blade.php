@extends('layouts.user')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Hasil Pencarian Pengajuan</h2>

        @if($pengajuan->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Form</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No Telpon</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Sosmed</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Permintaan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pengajuan as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $item->type === 'pedagang' ? 'Pedagang' : 'Umum' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $item->nama_lengkap }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $item->no_telpon }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ ucwords($item->status) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                                    @if($item->bukti_sosmed)
                                        <img src="{{ Storage::url($item->bukti_sosmed) }}" alt="Bukti Sosmed" class="w-16 h-16 object-cover rounded">
                                    @else
                                        Tidak ada bukti
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $item->permintaan }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center"
                                style="background-color: @if($item->status === 'approved') #d1fae5 @elseif($item->status === 'pending') #fef08a @elseif($item->status === 'rejected') #fce7f3 @endif;">
                                @if($item->status === 'approved')
                                    Selamat! Pengajuan Anda telah disetujui. Tim kami akan segera menghubungi Anda. Harap tetap pantau nomor telepon Anda.
                                @elseif($item->status === 'pending')
                                    Pengajuan Anda sedang kami proses. Terima kasih atas kesabarannya, silakan cek status secara berkala.
                                @elseif($item->status === 'rejected')
                                    Mohon maaf, pengajuan Anda belum dapat kami setujui. Anda dapat menghubungi admin untuk informasi lebih lanjut.
                                @endif
                            </td>                            
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-600">Tidak ada pengajuan ditemukan untuk email ini.</p>
        @endif

        <div class="mt-6 text-center">
            <a href="{{ url('/userform/search') }}" class="inline-block bg-blue-800 text-white py-2 px-4 rounded-md shadow hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Kembali</a>
        </div>
    </div>
</div>
@endsection
