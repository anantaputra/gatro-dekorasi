<?php

namespace App\Http\Controllers\User;

use App\Models\Paket;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;

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

    public function pesan($id)
    {
        $sewa = Paket::find($id);

        return view('user.form-sewa', compact('sewa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tgl_acara' => 'required',
            'tgl_kembali' => 'required',
            'lokasi' => 'required',
            'alamat_acara' => 'required',
            'nama_paket' => 'required',
            'catatan' => 'nullable',
        ]);

        $pesanan = new Pesanan();
        $pesanan->id_user = auth()->user()->id;
        $pesanan->id_paket = $request->nama_paket;
        $pesanan->lokasi = $request->lokasi;
        $pesanan->alamat_acara = $request->alamat_acara;
        $pesanan->tgl_acara = date('Y-m-d', strtotime($request->tgl_acara));
        $pesanan->tgl_kembali = date('Y-m-d', strtotime($request->tgl_kembali));
        $pesanan->catatan = $request->catatan;
        $pesanan->nama = $request->nama;
        $pesanan->save();

        return redirect()->route('user.pesanan')->with('success', 'Saat ini pesananmu sedang menunggu jawaban dari admin');
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

    public function konfirmasi($id)
    {
        $pesanan = Pesanan::find($id);
        if($pesanan->id_user == auth()->user()->id){
            return view('user.pembayaran', compact('pesanan'));
        } else {
            return abort(401);
        }
    }

    public function cetak($id)
    {
        $transaksi = Transaksi::where('id_pesanan', $id)
                    ->where('status','settlement')->first();

        return view('user.cetak-kwitansi', compact('transaksi'));
    }
}
