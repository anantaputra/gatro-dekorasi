<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pesanan;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLaporanController extends Controller
{
    public function penyewaan()
    {
        $penyewaan = Pesanan::where('status', 'booking')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);

        return view('admin.laporan.penyewaan', compact('penyewaan'));
    }

    public function filterSewa(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $penyewaan = Pesanan::where('status', 'booking')
                    ->whereBetween('tgl_acara', [$awal, $akhir])->get();   
        
        $no = 1;
        foreach($penyewaan as $item){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $item->usernya->name ?></td>
            <td><?= $item->paketnya->nama ?></td>
            <td>Rp<?= number_format($item->paketnya->harga, 0, '', '.') ?></td>
            <td><?= date("d/m/Y", strtotime($item->tgl_acara)) ?></td>
            <td><?= $item->alamat_acara ?></td>
            <td>
                <?php
                $status = AdminPengembalianController::status($item->id);
                if($status != 'Selesai'){
                    echo 'Rp1.000.000';
                } else {
                    echo 'Rp'.number_format($item->paketnya->harga, 0, '', '.');
                }
                ?>
            </td>
        </tr>      
        <?php
        }
    }

    public function cetakPenyewaan()
    {
        $penyewaan = Pesanan::where('status', 'booking')->get();

        return view('admin.laporan.cetak-penyewaan', compact('penyewaan'));
    }

    public function pengembalian()
    {
        $pengembalian = Pengembalian::orderBy('id', 'DESC')->paginate(15);

        return view('admin.laporan.pengembalian', compact('pengembalian'));
    }

    public function filterKembali(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $pengembalian = Pengembalian::select('*')
                    ->join('pesanan', 'pesanan.id', '=', 'pengembalian.id_pesanan')
                    ->whereBetween('tgl_kembali', [$awal, $akhir])
                    ->get();
        
        $no = 1;
        foreach($pengembalian as $item){
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $item->pesanannya->usernya->name ?></td>
            <td><?= $item->pesanannya->paketnya->nama ?></td>
            <td>Rp<?= number_format($item->pesanannya->paketnya->harga, 0, '', '.') ?></td>
            <td><?= date("d/m/Y", strtotime($item->pesanannya->tgl_acara)) ?></td>
            <td><?= $item->pesanannya->alamat_acara ?></td>
            <td><?= ($item->denda != null) ? 'Iya' : 'Tidak' ?></td>
            <td>
                <?php
                if($item->denda != null){
                    echo 'Rp'.number_format($item->denda, 0, '', '.');
                }
                ?>
            </td>
        </tr>      
        <?php
        }
    }

    public function cetakPengembalian()
    {
        $pengembalian = Pengembalian::all();

        return view('admin.laporan.cetak-pengembalian', compact('pengembalian'));
    }
}
