<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Bahan;
use App\Models\Menu;

class DashboardManajerController extends Controller
{
    public function index()
    {
        $penjualan = Pesanan::whereDate('tanggal_pesanan', today())
            ->where('status_pesanan', 'Selesai')
            ->sum('total_harga');

        $jumlahPesanan = Pesanan::whereDate('tanggal_pesanan', today())
            ->count();

        $jumlahMenu = Menu::count();

        $jumlahBahan = Bahan::count();

        return view('manajer.dashboard', compact(
            'penjualan',
            'jumlahPesanan',
            'jumlahMenu',
            'jumlahBahan'
        ));
    }
}

