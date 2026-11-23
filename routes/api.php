<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;

// API publik
Route::post('/pelanggan/register', [PelangganController::class, 'register']);
Route::post('/pelanggan/login', [PelangganController::class, 'login']);

Route::get('/menu', [MenuController::class, 'apiIndex']);
Route::get('/menu/{id}', [MenuController::class, 'apiShow']);

// API yang membutuhkan token pelanggan
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/pelanggan/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil.',
        ]);
    });

    // Tetap boleh diakses sebelum mengganti password
    Route::get('/pelanggan/profil', [PelangganController::class, 'profil']);
    Route::put('/pelanggan/ubah-password', [PelangganController::class, 'ubahPassword']);

    // Harus mengganti password terlebih dahulu
    Route::middleware(\App\Http\Middleware\CekPasswordPelanggan::class)->group(function () {
        Route::get('/pelanggan/riwayat-pesanan', [PesananController::class, 'riwayatMobile']);
        Route::post('/pelanggan/pesanan', [PesananController::class, 'storeMobile']);
    });
});
