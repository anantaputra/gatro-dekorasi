<?php

namespace App\Http\Controllers\Admin;

use App\Models\Paket;
use App\Models\Produk;
use App\Models\GambarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::paginate(10); // ambil data produk pagination 5

        $pakets = Paket::paginate(10); // ambil data paket pagination 5

        return view('admin.produk.index', compact('pakets', 'produk'));
    }

    public function tambah()
    {
        return view('admin.produk.tambah-produk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'gambar-1' => 'image',
            'gambar-2' => 'image',
            'gambar-3' => 'image',
            'gambar-4' => 'image',
            'gambar-5' => 'image',
            'gambar-6' => 'image',
        ]); // validasi form

        $produk = new Produk();
        // simpan ke databasenya
        // sesuai nama kolom table databse =  sesuai nama form input
        $produk->nama_produk = $request->nama;
        $produk->harga = $request->harga;
        $produk->save();

        // jika ada gambarnya baru bisa masuk ke database
        for ($i = 1; $i <= 6; $i++) {
            if ($request->file('gambar-'.$i)) {
                $filename = date('Ymd') . $request->file('gambar-'.$i)->getClientOriginalName();//buat nama filenya
                $request->file('gambar-'.$i)->move(public_path(). '/produk/detail', $filename);//simpan fotonya ke folder public/produk/detail
                $gambar = new GambarProduk();
                $gambar->id_produk = $produk->id;
                $gambar->img = $filename;
                $gambar->save();
            }
        }
        
        return redirect()->route('admin.produk');
    }

    public function ubah($id)
    {
        $produk = Produk::find($id);

        $gambar = GambarProduk::where('id_produk', $id)->get();
        
        return view('admin.produk.tambah-produk', compact('produk', 'gambar'));
    }

    public function edit(Request $request)
    {
        $produk = Produk::find($request->id);
        $gambar = GambarProduk::where('id_produk', $request->id)->get();

        for ($i = 1; $i <= 6; $i++) {
            if ($request->has('gambar-'.$i)) {
                if (isset($gambar[$i-1])){
                    $filename = date('Ymd') . $request->file('gambar-'.$i)->getClientOriginalName();
                    $move = $request->file('gambar-'.$i)->move(public_path(). '/produk/detail', $filename);
                    if ($move){
                        File::delete(public_path(). '/produk/detail/'.$request->input('picture_'.$i));
                        GambarProduk::where('id', $gambar[$i-1]->id)->update(['img' => $filename]);
                    }
                } else {
                    $filename = date('Ymd') . $request->file('gambar-'.$i)->getClientOriginalName();
                    $move = $request->file('gambar-'.$i)->move(public_path(). '/produk/detail', $filename);
                    $gambar = new GambarProduk();
                    $gambar->id_produk = $produk->id;
                    $gambar->img = $filename;
                    $gambar->save();
                }
            } else {
                if (isset($gambar[$i-1]) && $request->input('picture_'.$i) == null){
                    File::delete(public_path(). '/produk/detail/'.$gambar[$i-1]->img);
                    $gambar[$i-1]->delete();
                }
            }
        }

        $produk->nama_produk = $request->nama;
        $produk->harga = $request->harga;
        $produk->save();

        return redirect()->route('admin.produk');
    }

    public function delete($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect()->route('admin.produk');
    }
}
