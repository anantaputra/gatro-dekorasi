<?php

namespace App\Http\Controllers\User;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesananUserController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where('id_user', auth()->user()->id)->get(); // mengambil data pesanan dimana id_user pesanan adl id user yang login

        return view('user.pesanan', compact('pesanan')); // menampilkan view user.pesanan dengan membawa variabel pesanan
        // variabel sesuai dengan nama variabel yg sudah didefinisikan diatasnya
    }
}
