<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedagang;
use App\Models\Umum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedagang = Pedagang::all();
        $umum = Umum::all();

        return view('admin.forms.index', compact('pedagang', 'umum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:pedagang,umum',
            'email' => 'required|email|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'no_telpon' => 'required|numeric',
            'lokasi' => 'required_if:type,umum|string|max:255',
            'lokasi_pasar' => 'required_if:type,pedagang|string|max:255',
            'blok_pasar' => 'nullable|string|max:255',
            'akun_sosmed' => 'nullable|string|max:255',
            'bukti_sosmed' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'permintaan' => 'required|string|max:500',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $data = $request->except('type');

        if ($request->hasFile('bukti_sosmed')) {
            $data['bukti_sosmed'] = $request->file('bukti_sosmed')->store('public/bukti_sosmed');
        }

        if ($request->type === 'pedagang') {
            Pedagang::create($data);
        } else {
            Umum::create($data);
        }

        return redirect()->back()->with('success', 'Pengajuan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type, string $id)
    {
        if ($type === 'pedagang') {
            $data = Pedagang::findOrFail($id);
            return view('admin.forms.show', ['data' => $data, 'type' => 'pedagang']);
        } elseif ($type === 'umum') {
            $data = Umum::findOrFail($id);
            return view('admin.forms.show', ['data' => $data, 'type' => 'umum']);
        }

        return redirect()->back()->withErrors('Tipe data tidak valid.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $type, string $id)
    {
        if ($type === 'pedagang') {
            $data = Pedagang::findOrFail($id);
            return view('admin.forms.edit', ['data' => $data, 'type' => 'pedagang']);
        } elseif ($type === 'umum') {
            $data = Umum::findOrFail($id);
            return view('admin.forms.edit', ['data' => $data, 'type' => 'umum']);
        }

        return redirect()->back()->withErrors('Tipe data tidak valid.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $type, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'no_telpon' => 'required|numeric',
            'lokasi' => 'nullable|string|max:255',
            'lokasi_pasar' => 'nullable|string|max:255',
            'blok_pasar' => 'nullable|string|max:255',
            'akun_sosmed' => 'nullable|string|max:255',
            'bukti_sosmed' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'permintaan' => 'required|string|max:500',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $data = $request->except('bukti_sosmed');

        if ($request->hasFile('bukti_sosmed')) {
            $data['bukti_sosmed'] = $request->file('bukti_sosmed')->store('public/bukti_sosmed');
        }

        if ($type === 'pedagang') {
            $model = Pedagang::findOrFail($id);
            $model->update($data);
        } elseif ($type === 'umum') {
            $model = Umum::findOrFail($id);
            $model->update($data);
        } else {
            return redirect()->back()->withErrors('Tipe data tidak valid.');
        }

        return redirect()->route('admin.forms.index')->with('success', 'Pengajuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $type, string $id)
    {
        try {
            if ($type === 'pedagang') {
                $data = Pedagang::findOrFail($id);
                $data->delete();
            } elseif ($type === 'umum') {
                $data = Umum::findOrFail($id);
                $data->delete();
            } else {
                return redirect()->back()->withErrors('Tipe data tidak valid.');
            }

            return redirect()->route('admin.forms.index')->with('success', 'Pengajuan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
