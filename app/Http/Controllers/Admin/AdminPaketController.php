<?php

namespace App\Http\Controllers\Admin;

use App\Models\Paket;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\GambarPaket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminPaketController extends Controller
{
    public function tambah()
    {
        $kategoris = Kategori::all(); // ambil semua data kategori
 
        $produks = Produk::all(); // ambil semua data produk

        return view('admin.produk.tambah-paket', compact('kategoris', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jml_tamu' => 'nullable',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'gambar-1' => 'image',
            'gambar-2' => 'image',
            'gambar-3' => 'image',
            'gambar-4' => 'image',
            'gambar-5' => 'image',
            'gambar-6' => 'image',
        ]); // validasi form

        $paket  = new Paket();
        $paket->nama = $request->nama;
        $paket->harga = $request->harga;
        $paket->jml_tamu = $request->jml_tamu;
        $paket->id_kategori = $request->kategori;
        $checked    = $request->checkbox;
        $data       = $request->detail;
        $keterangan = $request->keterangan;
        if(isset($checked)){ // cek apakah ada produk yang di check atau centang
            foreach ($data as $key => $value) { // setiap data yang dicheck maka lakukan
                if (in_array($data[$key], $checked)) { // jika data dicheck 
                    $paket->isi_paket .= $data[$key].','; // isi paket = data,
                    $paket->keterangan .= $keterangan[$key].','; // keterangan = ket,
                } else { // jika data tidak dicheck
                    $paket->isi_paket .= ','; // isi paket = ,
                    $paket->keterangan .= ','; // keterangan = ,
                }
            }
        }
        $paket->deskripsi = $request->deskripsi;
        $paket->save();

        for ($i = 1; $i <= 6; $i++) { // looping input file atau gambar dari 1 - 6
            if ($request->file('gambar-'.$i)) { // jika file gambar-i diisi lakukan
                $filename = date('Ymd') . $request->file('gambar-'.$i)->getClientOriginalName();//buat nama filenya
                $request->file('gambar-'.$i)->move(public_path(). '/paket/detail', $filename);//simpan fotonya ke folder public/produk/detail
                $gambar = new GambarPaket();
                $gambar->id_paket = $paket->id;
                $gambar->img = $filename;
                $gambar->save();
            }
        }

        return redirect()->route('admin.produk')->with('success', 'Paket berhasil ditambahkan'); // redirect ke route admin.produk dengan membawa variabel success
    }

    public function ubah($id)
    {
        $paket = Paket::find($id); // cari data berdasarkan id

        $detail = $paket->isi_paket;
        $detail = explode(',', $detail);
        $ket = $paket->keterangan;
        $ket = explode(',', $ket);

        $produks = Produk::all();

        $kategoris = Kategori::all();

        $gambar = GambarPaket::where('id_paket', $id)->get();

        return view('admin.produk.tambah-paket', compact('paket', 'produks', 'kategoris', 'gambar', 'detail', 'ket'));
    }

    public function edit(Request $request)
    {
        $paket = Paket::find($request->id);

        for ($i = 1; $i <= 6; $i++) {
            if ($request->has('gambar-'.$i)) {
                if (isset($gambar[$i-1])){
                    $filename = date('Ymd') . $request->file('gambar-'.$i)->getClientOriginalName();
                    $move = $request->file('gambar-'.$i)->move(public_path(). '/paket/detail', $filename);
                    if ($move){
                        File::delete(public_path(). '/paket/detail/'.$request->input('picture_'.$i));
                        GambarPaket::where('id', $gambar[$i-1]->id)->update(['img' => $filename]);
                    }
                } else {
                    $filename = date('Ymd') . $request->file('gambar-'.$i)->getClientOriginalName();
                    $move = $request->file('gambar-'.$i)->move(public_path(). '/paket/detail', $filename);
                    $gambar = new GambarPaket();
                    $gambar->id_paket = $paket->id;
                    $gambar->img = $filename;
                    $gambar->save();
                }
            } else {
                if (isset($gambar[$i-1]) && $request->input('picture_'.$i) == null){
                    File::delete(public_path(). '/paket/detail/'.$gambar[$i-1]->img);
                    $gambar[$i-1]->delete();
                }
            }
        }

        $paket->nama = $request->nama;
        $paket->harga = $request->harga;
        $paket->jml_tamu = $request->jml_tamu;
        $paket->isi_paket = '';
        $paket->keterangan = '';
        if($request->has('checkbox')){
            $checked    = $request->checkbox;
            $data       = $request->detail;
            $keterangan = $request->keterangan;
            foreach ($data as $key => $value) {
                if (in_array($data[$key], $checked)) {
                    $paket->isi_paket .= $data[$key].',';
                    $paket->keterangan .= $keterangan[$key].',';
                } else {
                    $paket->isi_paket .= ',';
                    $paket->keterangan .= ',';
                }
            }
        }
        $paket->save();
        
        return redirect()->route('admin.produk');
    }

    public function delete($id)
    {
        $paket = Paket::find($id);
        $paket->delete();
        return redirect()->route('admin.produk');
    }
}
