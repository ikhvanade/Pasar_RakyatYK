<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\Pedagang;
use App\Models\Umum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Middleware untuk otentikasi dan hanya untuk admin
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // Redirect jika pengguna bukan admin
        if (Auth::check() && !Auth::user()->is_admin) {
            return redirect('/');
        }

        // Statistik jumlah entitas
        $marketCount = Market::count();
        $pedagangCount = Pedagang::count();
        $umumCount = Umum::count();
        $totalSubmissions = $pedagangCount + $umumCount;

        // Statistik mingguan
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $totalSubmissionsThisWeek = Pedagang::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count() +
                                    Umum::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

        $totalSubmissionsLastWeek = Pedagang::whereBetween('created_at', [$startOfWeek->copy()->subWeek(), $endOfWeek->copy()->subWeek()])->count() +
                                     Umum::whereBetween('created_at', [$startOfWeek->copy()->subWeek(), $endOfWeek->copy()->subWeek()])->count();

        // Perubahan persentase
        $percentageChange = $totalSubmissionsLastWeek > 0
            ? (($totalSubmissionsThisWeek - $totalSubmissionsLastWeek) / $totalSubmissionsLastWeek) * 100
            : ($totalSubmissionsThisWeek > 0 ? 100 : 0);

        // Data untuk grafik
        $pedagangMonthly = Pedagang::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $umumMonthly = Umum::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Mengambil bulan pertama data masuk
        $firstMonth = min(
            $pedagangMonthly->min('month') ?? 1,
            $umumMonthly->min('month') ?? 1
        );

        // Map data ke array
        $pedagangMonthlyData = $pedagangMonthly->pluck('count', 'month')->toArray();
        $umumMonthlyData = $umumMonthly->pluck('count', 'month')->toArray();

        $pedagangData = array_fill(0, 12, 0); // Isi awal data menjadi array 12 elemen kosong
        $umumData = array_fill(0, 12, 0);

        // Memulai dari bulan pertama data masuk
        foreach ($pedagangMonthlyData as $month => $count) {
            $pedagangData[$month - 1] = $count; // Disesuaikan ke index array (bulan ke-1 menjadi index 0)
        }

        foreach ($umumMonthlyData as $month => $count) {
            $umumData[$month - 1] = $count;
        }

        $pedagang = Pedagang::all();
        $umum = Umum::all();

        // Return data ke view
        return view('dashboard', compact(
            'marketCount',
            'pedagangCount',
            'umumCount',
            'pedagangData',
            'umumData',
            'totalSubmissions',
            'totalSubmissionsThisWeek',
            'totalSubmissionsLastWeek',
            'percentageChange',
            'firstMonth',
            'pedagang',
            'umum'
        ));
    }

    public function exportPedagang()
    {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Data Pedagang');

    // Header
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Nama Lengkap');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'No. Telepon');
    $sheet->setCellValue('E1', 'Lokasi Pasar');
    $sheet->setCellValue('F1', 'Blok Pasar');
    $sheet->setCellValue('G1', 'Akun Sosmed');
    $sheet->setCellValue('H1', 'Permintaan');
    $sheet->setCellValue('I1', 'Status');
    $sheet->setCellValue('J1', 'Tanggal Pengajuan');

    // Data
    $pedagang = Pedagang::all();
    $row = 2;
    foreach ($pedagang as $data) {
        $sheet->setCellValue("A{$row}", $data->id);
        $sheet->setCellValue("B{$row}", $data->nama_lengkap);
        $sheet->setCellValue("C{$row}", $data->email);
        $sheet->setCellValue("D{$row}", $data->no_telpon);
        $sheet->setCellValue("E{$row}", $data->lokasi_pasar);
        $sheet->setCellValue("F{$row}", $data->blok_pasar);
        $sheet->setCellValue("G{$row}", $data->akun_sosmed);
        $sheet->setCellValue("H{$row}", $data->permintaan);
        $sheet->setCellValue("I{$row}", $data->status);
        $sheet->setCellValue("J{$row}", $data->created_at->format('Y-m-d'));
        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'data_pedagang.xlsx';
    $temp_file = tempnam(sys_get_temp_dir(), $filename);
    $writer->save($temp_file);

    return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
}

    public function exportUmum()
    {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Data Umum');

    // Header
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Nama Lengkap');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'No. Telepon');
    $sheet->setCellValue('E1', 'Lokasi');
    $sheet->setCellValue('F1', 'Akun Sosmed');
    $sheet->setCellValue('G1', 'Permintaan');
    $sheet->setCellValue('H1', 'Status');
    $sheet->setCellValue('I1', 'Tanggal Pengajuan');

    // Data
    $umum = Umum::all();
    $row = 2;
    foreach ($umum as $data) {
        $sheet->setCellValue("A{$row}", $data->id);
        $sheet->setCellValue("B{$row}", $data->nama_lengkap);
        $sheet->setCellValue("C{$row}", $data->email);
        $sheet->setCellValue("D{$row}", $data->no_telpon);
        $sheet->setCellValue("E{$row}", $data->lokasi);
        $sheet->setCellValue("F{$row}", $data->akun_sosmed);
        $sheet->setCellValue("G{$row}", $data->permintaan);
        $sheet->setCellValue("H{$row}", $data->status);
        $sheet->setCellValue("I{$row}", $data->created_at->format('Y-m-d'));
        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'data_umum.xlsx';
    $temp_file = tempnam(sys_get_temp_dir(), $filename);
    $writer->save($temp_file);

    return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }
}
