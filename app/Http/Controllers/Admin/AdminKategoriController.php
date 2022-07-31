<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminKategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all(); // mengambil semua data dari kategori

        return view('admin.kategori.index', compact('kategoris'));
    }

    public function tambah()
    {
        return view('admin.kategori.tambah');
    }

    //simpan kategori
    public function store(Request $request) 
    {
        $request->validate([
            'kategori' => 'required'
        ]); // validasi form 

        $kategori = new Kategori();
        $kategori->nama = $request->kategori;
        $kategori->save();
        return redirect()->route('admin.kategori');
    }

    public function ubah($id)
    {
        $kategori = Kategori::find($id); // cari data kategori berdasarkan id

        return view('admin.kategori.tambah', compact('kategori'));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'kategori' => 'required'
        ]); // validasi form 

        $kategori = Kategori::find($request->id);
        $kategori->nama = $request->kategori;
        $kategori->save();
        return redirect()->route('admin.kategori');
    }

    public function delete($id)
    {
        $kategori = Kategori::find($id); // cari data
        $kategori->delete(); // hapus data
        return redirect()->route('admin.kategori'); // redirect ke route admin.kategori
    }
}
