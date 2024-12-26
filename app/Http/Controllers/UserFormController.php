<?php

namespace App\Http\Controllers;
use App\Models\Pedagang;
use App\Models\Umum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserFormController extends Controller
{
    /**
     * Tampilkan halaman form utama.
     */
    public function index()
    {
        return view('userform.form'); // Pastikan view file bernama 'form.blade.php' di folder 'user'
    }

    /**
     * Simpan data form pedagang.
     */
    public function submit(Request $request)
    {
        $formType = $request->input('form_type');
        $emailValidation = 'required|email|max:255';
        // Tentukan validasi berdasarkan tipe form
        if ($formType === 'pedagang') {
            $validated = $request->validate([
                'email' => $emailValidation,
                'nama_lengkap' => 'required|string|max:255',
                'no_telpon' => 'required|string|max:15',
                'lokasi_pasar' => 'required|string|max:255',
                'blok_pasar' => 'required|string|max:50',
                'akun_sosmed' => 'required|string|max:255',
                'bukti_sosmed' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
                'permintaan' => 'required|string',
            ]);

            // Simpan data ke tabel pedagang
            $model = new Pedagang();
        } elseif ($formType === 'umum') {
            $validated = $request->validate([
                'email' => $emailValidation,
                'nama_lengkap' => 'required|string|max:255',
                'no_telpon' => 'required|string|max:15',
                'lokasi' => 'required|string|max:255',
                'akun_sosmed' => 'required|string|max:255',
                'bukti_sosmed' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
                'permintaan' => 'required|string',
            ]);

            // Simpan data ke tabel umum
            $model = new Umum();
        }else{
            return redirect()->back()
                ->with('error', 'Tipe form tidak valid.')
                ->withInput();
        }

        try {
            // Handle file upload
            if ($request->hasFile('bukti_sosmed')) {
                $file = $request->file('bukti_sosmed');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/bukti_sosmed', $filename);
                // Hapus 'public/' dari path saat menyimpan ke database
                $url = str_replace('public/', '', $path);
            }
            
            $dataToSave = array_intersect_key($validated, array_flip($model->getFillable()));
            // Simpan data ke database
            $dataToSave['bukti_sosmed'] = $url ?? null;
            $dataToSave['status'] = 'pending';

            // Simpan data ke database
            $model->fill($dataToSave);
            $model->save();

            return response()->json(['message' => 'Pengajuan berhasil dikirim!']);
        } catch (\Exception $e) {
            Log::error('Error submitting form: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat mengirim pengajuan.'], 500);
        }
    }
    // Metode baru untuk mencari pengajuan berdasarkan email
    public function search(Request $request)
    {
        $email = $request->input('email');

        // Cari pengajuan di kedua tabel berdasarkan email
        $pedagangPengajuan = Pedagang::where('email', $email)->get();
        $umumPengajuan = Umum::where('email', $email)->get();

        // Gabungkan hasil dan tambahkan tipe form
        $pengajuan = $pedagangPengajuan->map(function ($item) {
            $item->type = 'pedagang';
            return $item;
        })->concat($umumPengajuan->map(function ($item) {
            $item->type = 'umum';
            return $item;
        }));

        return view('userform.search-result', compact('pengajuan'));
    }
}