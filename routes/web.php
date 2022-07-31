<?php

use App\Http\Controllers\Admin\AdminGaleriController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\PesananUserController;
use App\Http\Controllers\User\ProfilUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::prefix('profil')->group(function(){
        Route::get('/', [ProfilUserController::class, 'index'])->name('user.profil'); // route user.profil
        Route::post('/', [ProfilUserController::class, 'simpan'])->name('user.profil.simpan'); // route user.profil.simpan
    });

    Route::prefix('pesanan')->group(function(){
        Route::get('/', [PesananUserController::class, 'index'])->name('user.pesanan'); // route user.pesanan
        Route::get('batal/{id}', [PesananUserController::class, 'batal'])->name('user.pesanan.batal'); // route user.pesanan.batal untuk membatalkan pesanan user
    });
});

// route untuk admin
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function(){
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');
    Route::prefix('pesanan')->group(function(){
        Route::get('/', [AdminPesananController::class, 'index'])->name('admin.pesanan');
    });
    Route::prefix('ketegori')->group(function(){
        Route::get('/', [AdminKategoriController::class, 'index'])->name('admin.kategori');
        Route::get('tambah', [AdminKategoriController::class, 'tambah'])->name('admin.kategori.tambah');
        Route::post('tambah', [AdminKategoriController::class, 'store'])->name('admin.kategori.simpan');
        Route::get('edit/{id}', [AdminKategoriController::class, 'ubah'])->name('admin.kategori.ubah');
        Route::post('edit', [AdminKategoriController::class, 'edit'])->name('admin.kategori.edit');
        Route::get('hapus/{id}', [AdminKategoriController::class, 'delete'])->name('admin.kategori.hapus');
    });
    Route::prefix('produk')->group(function(){
        Route::get('/', [AdminPesananController::class, 'index'])->name('admin.produk');
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