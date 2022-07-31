<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonversiController extends Controller
{
    public static function tgl($tanggal)
    {
        $bulan = ['', // index 0 diberi string kosong karena tidak ada bulan 0
                'Januari', // bulan 1 atau index 1
                'Februari', // bulan 2 atau index 2
                'Maret', // bulan 3 atau index 3
                'April', // bulan 4 atau index 4
                'Mei', // bulan 5 atau index 5
                'Juni', // bulan 6 atau index 6
                'Juli', // bulan 7 atau index 7
                'Agustus', // bulan 8 atau index 8
                'September', // bulan 9 atau index 9
                'Oktober', // bulan 10 atau index 10
                'November', // bulan 11 atau index 11
                'Desember']; // bulan 12 atau index 12
        $date = explode('-', $tanggal); // memecah string atau tgl sesuai -
        $tgl = $date[2]; // variabel tanggal merupakan index terakhir atau index ke 2
        $bln = (int) $date[1]; // variabel tanggal merupakan index tengah atau index ke 1
        $thn = $date[0]; // variabel tanggal merupakan index pertama atau index ke 0
        return $tgl." ".$bulan[$bln]." ".$thn; // ubah menjadi tgl bulannya tahun
    }
}
