<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Api\MidtransSnapController;
use Carbon\Carbon;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiUserController extends Controller
{
    public function store(Request $request)
    {
        $transaksi = Transaksi::latest()->first(); // mengambil data transaksi terakhir

        $tgl_transaksi = Carbon::today()->toDateString(); // mengambil tanggal hari ini
        $tgl_transaksi = explode('-', $tgl_transaksi); // memecah tanggal hari ini
        $tgl_transaksi = $tgl_transaksi[0].$tgl_transaksi[1].$tgl_transaksi[2]; // merubah format tgl dengan menghilangkan tanda -
        if($transaksi){ // jika ada data transaksi terakhir
            $kode = $transaksi->kd_transaksi; // ambil kode transaksi
            $tgl = substr($kode, 0, 8); // ambil 8 karakter dari depan atau dengan kata lain mengambil tanggal transaksinya, karena kode transaksi berupa tgl hari ini 8 digit dan tambahan 3 digit nomor urut
            if ($tgl == $tgl_transaksi){ // jika tgl hari ini dan tgl transaksi sama
                $id = (int) substr($kode, 8, 3); // ambil 3 digit akhir kode transaksi dan ubah menjadi tipe data integer
                $id++; // increment atau +1 pada nomor urut atau id
                $kd_transaksi = $tgl_transaksi . sprintf("%03s", $id); // pasang kembali kode transaksi menjadi tgl transaksinya + nomor urut
            } else { // jika blm ada transaksi pada tanggal hari ini
                $kd_transaksi = $tgl_transaksi . '001'; // kode transaksi berupa tgl hari ini + nomor urut 001
            }
        } else { // jika blm ada riwayat transaksi sama sekali
            $kd_transaksi = $tgl_transaksi . '001'; // kode transaksi berupa tgl hari ini + nomor urut 001
        }

        $transaksi = new Transaksi();
        $transaksi->kd_transaksi = $kd_transaksi;
        $transaksi->id_pesanan = $request->id_pesanan;
        if(isset($request->bayar)){ // jika ada inputan name=bayar yg ada di paket wedding dan engagement
            $transaksi->pembayaran = $request->bayar;
            if($request->bayar == 'dp'){ // jika bayar = dp 
                $transaksi->total = $request->nominal; // maka total = nominal dp yg diisikan atau yg ada dlm input name=nominal
            } else { // jika bayar = lunas
                $pesanan = Pesanan::find($request->id_pesanan); // cari data pesanan berdasarkan id pesanan
                $transaksi->total = $pesanan->paketnya->harga; // maka total = harga dari paket tersebut
            }
        } else { // jika tidak ada input name=bayar atau pada paket kategori lain-lain
            $transaksi->pembayaran = 'lunas'; // pembayaran akan langsung di set lunas
            $pesanan = Pesanan::find($request->id_pesanan); // cari data pesanan berdasarkan id pesanan
            $transaksi->total = $pesanan->paketnya->harga;// maka total = harga dari paket tersebut
        }
        $snapToken = MidtransSnapController::snap($kd_transaksi, $transaksi->total, auth()->user()->name, auth()->user()->email); // panggil fungsi snap pada MidtransSnapController untuk generate token
        $transaksi->transaction_id = $snapToken; // simpan token pada kolom transaction_id
        $transaksi->status = 'pending'; // set status menjadi pending
        $transaksi->save();

        return redirect()->route('user.bayar', ['token' => $snapToken]); // recirect ke route pembayaran dengan membawa variabel token
    }

    public function bayar($token)
    {
        $snapToken = $token;

        return view('user.bayar-snap', compact('snapToken'));
    }

    public function update(Request $request)
    {
        $json = json_decode($request->json);
        $transaksi = Transaksi::where('transaction_id', $request->id)->first();
        $transaksi->payment_type = $json->payment_type;
        $transaksi->status = $json->transaction_status;
        $transaksi->save();

        return redirect()->route('user.pesanan');
    }
}
