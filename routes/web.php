<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\HargaBahanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DashboardManajerController;
use App\Http\Controllers\ImportDataController;


Route::get('/', function () {
    return redirect()->route('login');
});

    //halaman login
    Route::get('/login', [Authcontroller::class,'showLogin'])->name('login');
    Route::post('/login', [Authcontroller::class, 'login'])->name('login.process');
    Route::post('/logout', [Authcontroller::class, 'logout'])->name('logout');

    //semua harus login dlu
    Route::middleware('auth')->group(function(){


    //bagian manajer
Route::middleware('role:manajer')->group(function(){
    Route::get('/manajer/dashboard', [DashboardManajerController::class, 'index'])->name('manajer.dashboard');

    //kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

    //sinkron harga bahan
    Route::post('/harga-bahan/sinkronisasi', [HargaBahanController::class, 'sinkronisasi'])->name('harga-bahan.sinkronisasi');

    //bahan
    Route::get('/bahan',[BahanController::class, 'index'])->name('bahan.index');
    Route::post('/bahan',[BahanController::class,'store'])->name('bahan.store');
    Route::put('/bahan/{id}', [BahanController::class, 'update'])->name('bahan.update');
    Route::delete('/bahan/{id}', [BahanController::class, 'destroy'])->name('bahan.destroy');

    //resep
    Route::get('/resep', [ResepController::class, 'index'])->name('resep.index');
    Route::post('/resep', [ResepController::class, 'store'])->name('resep.store');
    Route::put('/resep/{id}', [ResepController::class, 'update'])->name('resep.update');
    Route::delete('/resep/{id}', [ResepController::class, 'destroy'])->name('resep.destroy');

    //stok masuk
    Route::get('/stok-masuk',[StokMasukController::class,'index'])->name('stok-masuk.index');
    Route::post('/stok-masuk',[StokMasukController::class,'store'])->name('stok-masuk.store');
    Route::get('/stok-masuk/{id}',[StokMasukController::class,'show'])->name('stok-masuk.show');

    //menu manajer(crud)
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

    //import data
    Route::get('/import-data',[ImportDataController::class,'index'])->name('import-data.index');
    Route::post('/import-data',[ImportDataController::class,'import'])->name('import-data.import');


    //laporan
    Route::get('/laporan',[LaporanController::class,'index'])->name('laporan.index');
    });



    //bagian kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/buat-pesanan', [MenuController::class, 'buatPesanan'])->name('kasir.buat-pesanan');


    //menu hanya dilihat
    Route::get('/kasir/menu', [MenuController::class, 'halamanKasir'])->name('kasir.menu.index');
    Route::get('/kasir/menu/{id}', [MenuController::class, 'show'])->name('kasir.menu.show');

    //pesanan
    Route::get('/kasir/pesanan/{id}/struk', [PesananController::class, 'strukKasir'])->name('kasir.pesanan.struk');
    Route::get('/kasir/pesanan', [PesananController::class, 'halamanKasir'])->name('kasir.pesanan');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::put('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.status');
    Route::put('/pesanan/{id}/batal',[PesananController::class,'batal'])->name('pesanan.batal');



    //reset pw
    Route::get('/kasir/pelanggan', [PelangganController::class, 'halamanKasir'])->name('kasir.pelanggan.index');
    Route::put('/pelanggan/{id}/reset-password', [PelangganController::class, 'resetPassword'])->name('pelanggan.reset-password');

    });
});