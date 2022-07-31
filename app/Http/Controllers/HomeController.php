<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Galeri;
use App\Models\Produk;
use App\Models\GambarPaket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $carousels = Galeri::all();

        $pakets = Paket::all();

        $produks = Produk::all();

        return view('welcome', compact('carousels', 'pakets', 'produks'));
    }

    public function detail($id)
    {
        $paket = Paket::find($id);

        $gambar = GambarPaket::where('id_paket', $id)->get();
        
        return view('detail', compact('paket', 'gambar'));
    }
}
