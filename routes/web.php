<?php

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
    });
});