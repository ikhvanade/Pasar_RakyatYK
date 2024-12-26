<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarketController extends Controller
{
    public function index()
    {
        $markets = Market::paginate(6);
        return view('admin.markets.index', ['markets' => $markets]);
    }

    public function create()
    {
        return view('admin.markets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'jam_operasional' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_content' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_tambah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jumlah_pedagang' => 'required',
            'luas_tanah' => 'required',
            'luas_bangunan' => 'required',
        ]);

        $data = $request->all();

        // Simpan gambar utama
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        // Simpan gambar konten
        if ($request->hasFile('image_content')) {
            $data['image_content'] = $request->file('image_content')->store('images', 'public');
        }

        if ($request->hasFile('image_tambah')) {
            $data['image_tambah'] = $request->file('image_tambah')->store('images', 'public');
        }

        Market::create($data);

        return redirect()->route('admin.markets.index')->with('success', 'Market added successfully!');
    }

    public function show(Market $market)
    {
        return view('admin.markets.show', compact('market'));
    }

    public function edit(Market $market)
    {
        return view('admin.markets.edit', compact('market'));
    }

    public function update(Request $request, Market $market)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'jam_operasional' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_content' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_tambah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jumlah_pedagang' => 'required',
            'luas_tanah' => 'required',
            'luas_bangunan' => 'required',
        ]);

        $data = $request->all();

        // Update gambar utama
        if ($request->hasFile('image')) {
            if ($market->image) {
                Storage::disk('public')->delete($market->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        // Update gambar konten
        if ($request->hasFile('image_content')) {
            if ($market->image_content) {
                Storage::disk('public')->delete($market->image_content);
            }
            $data['image_content'] = $request->file('image_content')->store('images', 'public');
        }

        if ($request->hasFile('image_tambah')){
            if ($market->image_tambah) {
                Storage::disk('public')->delete($market->image_tambah);
            }
            $data['image_tambah'] = $request->file('image_tambah')->store('images', 'public');
        }

        $market->update($data);

        return redirect()->route('admin.markets.index')->with('success', 'Market updated successfully!');
    }

    public function destroy(Market $market)
    {
        if ($market->image) {
            Storage::disk('public')->delete($market->image);
        }
        if ($market->image_content) {
            Storage::disk('public')->delete($market->image_content);
        }
        if ($market->image_tambah){
            Storage::disk('public')->delete($market->image_tambah);
        }

        $market->delete();

        return redirect()->route('admin.markets.index')->with('success', 'Market deleted successfully!');
    }
}
