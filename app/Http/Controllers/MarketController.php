<?php

namespace App\Http\Controllers;
use App\Models\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil nilai pencarian dari request
        $search = $request->input('search');
        $request->validate(['search' => 'nullable|string|max:255']);


        // Query utama untuk mengambil semua pasar
        $query = Market::query();

        // Filter data berdasarkan pencarian
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        // Menggunakan paginate dengan appends untuk mempertahankan query string pencarian
        $markets = $query->paginate(6)->appends(['search' => $search]);

        // Mengembalikan data ke view
        return view('markets.index', compact('markets'));
    }




    public function show(Market $market)
    {
        return view('markets.show', compact('market'));
    }

}
