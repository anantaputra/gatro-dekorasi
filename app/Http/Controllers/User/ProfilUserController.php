<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilUserController extends Controller
{
    public function index()
    {
        $profil = User::find(auth()->user()->id); // cari user berdasarkan id user yang login

        return view('user.profil', compact('profil')); // menampilkan view user.profil dengan membawa variabel profil
        // variabel sesuai dengan nama variabel yg sudah didefinisikan diatasnya
    }

    public function simpan(Request $request)
    {
        $profil = User::find(auth()->user()->id); // cari user berdasarkan id user yang login
        // sesuai dengan kolom db == // sesuai dengan input form
        $profil->name = $request->nama; // update name user
        $profil->email = $request->email; // update email user
        $profil->no_hp1 = $request->no_hp1; // update no hp1 user
        $profil->no_hp2 = $request->no_hp2; // update no hp2 user
        $profil->kota = $request->kota; // update kota user
        $profil->alamat = $request->alamat; // update alamat user
        $profil->save(); // simpan data yang sudah dideskripsikan diatas

        return redirect()->route('user.profil'); // setelah simpan data akan diarahkan atau redirect ke route user.profil
    }
}
