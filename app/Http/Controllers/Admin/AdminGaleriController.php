<?php

namespace App\Http\Controllers\Admin;

use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminGaleriController extends Controller
{
    public function index()
    {
        $photos = Galeri::all();

        return view('admin.galeri.index', compact('photos'));
    }
    
    public function tambah()
    {
        return view('admin.galeri.tambah');
    }
    
    public function store(Request $request)
    {
        $data = new Galeri();

        if($request->file('gambar')){
            $file = $request->file('gambar');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/galeri'), $filename);
            $data->gambar = $filename;
        }
        $data->save();
        return redirect()->route('admin.galeri');
    }

    public function delete($id)
    {
        $gambar = Galeri::find($id);

        if($gambar){
            Storage::delete('public/galeri'.$gambar->gambar.'');
            $gambar->delete();
        }
        return redirect()->route('admin.galeri');
    }
}
