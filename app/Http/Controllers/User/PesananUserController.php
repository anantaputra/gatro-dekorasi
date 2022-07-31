<?php

namespace App\Http\Controllers\User;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PesananUserController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where('id_user', auth()->user()->id) // mengambil data pesanan dimana id_user pesanan adl id user yang login
                ->orderBy('id', 'DESC') // urutkan dari belakang atau terbaru atau Z-A
                ->paginate(10); // batasi per halaman 10 data

        return view('user.pesanan', compact('pesanan')); // menampilkan view user.pesanan dengan membawa variabel pesanan
        // variabel sesuai dengan nama variabel yg sudah didefinisikan diatasnya
    }

    public function batal($id)
    {
        $pesanan = Pesanan::find($id); // cari data berdasarkan id yang diberikan
        if($pesanan->id_user != auth()->user()->id){ // jika yg melakukan pembatalan bukan user pemesan
            return abort(401); // maka akan ditampilkan halaman terlarang atau forbidden
        }
        $pesanan->status = 'dibatalkan'; // set status dibatalkan
        $pesanan->save();

        return redirect()->route('user.pesanan'); // setelah simpan data akan diarahkan atau redirect ke route user.pesanan
    }
}
