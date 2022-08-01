<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pesanan;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pesanan::where('tgl_kembali', today())->where('status', 'booking')->get();

        return view('admin.pengembalian.index', compact('pengembalian'));
    }

    public function pengembalian($id)
    {
        $pesanan = Pesanan::find($id);

        return view('admin.pengembalian.form', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $id_pesanan = $request->id_pesanan;
        $denda = $request->denda;
        $keterangan = $request->keterangan;

        $pengembalian = new Pengembalian();
        $pengembalian->id_pesanan = $id_pesanan;
        if(!empty($denda)){
            $pengembalian->denda = $denda;
            $pengembalian->keterangan = $keterangan;
        }
        $pengembalian->save();
        return redirect()->route('admin.pengembalian');
    }

    public static function status($id)
    {
        $status = Pengembalian::where('id_pesanan', $id)->get();

        if(count($status) > 0){
            return 'Selesai';
        }
    }
}
