<?php

namespace App\Http\Controllers\Admin;

use App\Models\Paket;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Kategori;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function index()
    {
        $kategori = count(Kategori::all()); // menghitung jumlah semua data dari kategori

        $produk = count(Produk::all()); // menghitung jumlah semua data dari produk

        $paket = count(Paket::all()); // menghitung jumlah semua data dari paket

        $penyewaan = count(Pesanan::where('status', 'booking')->get()); // menghitung jumlah semua data dari pesanan yang sudah dibayar

        $pengembalian = count(Pengembalian::all()); // menghitung jumlah semua data dari pengembalian

        return view('admin.home', compact('kategori', 'produk', 'paket', 'penyewaan', 'pengembalian'));
    }
}
