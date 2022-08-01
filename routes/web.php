<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\User\ProfilUserController;
use App\Http\Controllers\User\PesananUserController;
use App\Http\Controllers\Admin\AdminGaleriController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminPaketController;
use App\Http\Controllers\User\TransaksiUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home'); // route home

Route::get('detail/{id}', [HomeController::class, 'detail'])->name('detail'); // route detail memerlukan variabel id setiap dipanggil

Auth::routes();

// route untuk user yang sudah login
Route::group(['middleware' => 'auth'], function(){
    Route::prefix('user/profil')->group(function(){
        Route::get('/', [ProfilUserController::class, 'index'])->name('user.profil'); // route user.profil
        Route::post('/', [ProfilUserController::class, 'simpan'])->name('user.profil.simpan'); // route user.profil.simpan
    });

    Route::prefix('user/pesanan')->group(function(){
        Route::get('/', [PesananUserController::class, 'index'])->name('user.pesanan'); // route user.pesanan
        Route::get('batal/{id}', [PesananUserController::class, 'batal'])->name('user.pesanan.batal'); // route user.pesanan.batal untuk membatalkan pesanan user
    });

    Route::prefix('sewa')->group(function(){
        Route::get('paket/{id}', [PesananUserController::class, 'pesan'])->name('user.sewa');
        Route::post('simpan', [PesananUserController::class, 'store'])->name('user.sewa.simpan');
        Route::get('{id}/konfirmasi', [PesananUserController::class, 'konfirmasi'])->name('user.konfirmasi');
        Route::post('snap-bayar', [TransaksiUserController::class, 'store'])->name('snap-bayar');
        Route::get('bayar/{token}', [TransaksiUserController::class, 'bayar'])->name('user.bayar');
        Route::post('bayar', [TransaksiUserController::class, 'update'])->name('update.pembayaran');
        Route::get('nota/{id}/cetak', [PesananUserController::class, 'cetak'])->name('user.cetak.nota');
    });

});

// route untuk admin
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function(){
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');
    Route::prefix('pesanan')->group(function(){
        Route::get('/', [AdminPesananController::class, 'index'])->name('admin.pesanan');
        Route::post('filter', [AdminPesananController::class, 'filter'])->name('admin.pesanan.filter');
        Route::get('/respons/{id}', [AdminPesananController::class, 'detail'])->name('admin.pesanan.respons');
        Route::get('/{id}/terima', [AdminPesananController::class, 'terima'])->name('admin.pesanan.terima');
        Route::get('/{id}/tolak', [AdminPesananController::class, 'tolak'])->name('admin.pesanan.tolak');
    });
    Route::prefix('kategori')->group(function(){
        Route::get('/', [AdminKategoriController::class, 'index'])->name('admin.kategori');
        Route::get('tambah', [AdminKategoriController::class, 'tambah'])->name('admin.kategori.tambah');
        Route::post('tambah', [AdminKategoriController::class, 'store'])->name('admin.kategori.simpan');
        Route::get('edit/{id}', [AdminKategoriController::class, 'ubah'])->name('admin.kategori.ubah');
        Route::post('edit', [AdminKategoriController::class, 'edit'])->name('admin.kategori.edit');
        Route::get('hapus/{id}', [AdminKategoriController::class, 'delete'])->name('admin.kategori.hapus');
    });
    Route::prefix('produk')->group(function(){
        Route::get('/', [AdminProdukController::class, 'index'])->name('admin.produk');
        Route::get('tambah', [AdminProdukController::class, 'tambah'])->name('admin.produk.tambah');
        Route::post('tambah', [AdminProdukController::class, 'store'])->name('admin.produk.simpan');
        Route::get('edit/{id}', [AdminProdukController::class, 'ubah'])->name('admin.produk.ubah');
        Route::post('edit', [AdminProdukController::class, 'edit'])->name('admin.produk.edit');
        Route::get('hapus/{id}', [AdminProdukController::class, 'delete'])->name('admin.produk.hapus');

        //Routes views paket 
        Route::prefix('paket')->group(function(){
            Route::get('tambah', [AdminPaketController::class, 'tambah'])->name('admin.paket.tambah');
            Route::post('tambah', [AdminPaketController::class, 'store'])->name('admin.paket.simpan');
            Route::get('edit/{id}', [AdminPaketController::class, 'ubah'])->name('admin.paket.ubah');
            Route::post('edit', [AdminPaketController::class, 'edit'])->name('admin.paket.edit');
            Route::get('hapus/{id}', [AdminPaketController::class, 'delete'])->name('admin.paket.hapus');
        });
    });
    Route::prefix('galeri')->group(function(){
        Route::get('/', [AdminGaleriController::class, 'index'])->name('admin.galeri');
        Route::get('/tambah', [AdminGaleriController::class, 'tambah'])->name('admin.galeri.tambah');
        Route::post('/tambah', [AdminGaleriController::class, 'store'])->name('admin.galeri.simpan');
        Route::get('/hapus/{id}', [AdminGaleriController::class, 'delete'])->name('admin.galeri.hapus');
    });
    Route::prefix('pengembalian')->group(function(){
        Route::get('/', [AdminPesananController::class, 'index'])->name('admin.pengembalian');
    });
    Route::prefix('laporan')->group(function(){
        Route::get('penyewaan', [AdminPesananController::class, 'index'])->name('admin.laporan.penyewaan');
        Route::get('pengembalian', [AdminPesananController::class, 'index'])->name('admin.laporan.pengembalian');
    });
});