<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;

Route::get('/', function () {
    return view('welcome');
});

//halaman login
Route::get('/login', [Authcontroller::class,'showLogin'])
->name('login');

//proses login
Route::post('/login', [Authcontroller::class, 'login'])
->name('login.process');

//prosess logout
Route::post('/logout', [Authcontroller::class, 'logout'])
->name('logout');

//dash manajer dan kasir
Route::middleware('auth')->group(function(){
    Route::get('/manajer/dashboard', function(){
        return view ('manajer.dashboard');
    })->name('manajer.dashboard');
    
    Route::get('/kasir/dashboard', function(){
        return view ('kasir.dashboard');
    })->name('kasir.dashboard');
});
