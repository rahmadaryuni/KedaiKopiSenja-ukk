<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Menu;
use App\Models\Bahan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Periode laporan: default dari awal bulan sampai hari ini
        $tanggalMulai = $request->input(
            'tanggal_mulai',
            Carbon::now()->startOfMonth()->format('Y-m-d')
        );

        $tanggalAkhir = $request->input(
            'tanggal_akhir',
            Carbon::now()->format('Y-m-d')
        );

        // Validasi periode
        $request->validate([
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        //laporan per menu

        $detailPenjualan = DetailPesanan::with(['menu', 'pesanan'])
            ->whereHas('pesanan', function ($query) use ($tanggalMulai, $tanggalAkhir) {
                $query->whereRaw(
                    'LOWER(TRIM(status_pesanan)) = ?',
                    ['selesai']
                )
                ->whereDate('tanggal_pesanan', '>=', $tanggalMulai)
                ->whereDate('tanggal_pesanan', '<=', $tanggalAkhir);
            })
            ->get();

        $penjualanMenu = $detailPenjualan
            ->filter(function ($detail) {
                return $detail->menu !== null;
            })
            ->groupBy('id_menu')
            ->map(function ($details) {
                $menu = $details->first()->menu;

                return [
                    'nama_menu' => $menu->nama_menu,
                    'jumlah_terjual' => $details->sum('jumlah'),
                    'total_penjualan' => $details->sum('subtotal'),
                ];
            })
            ->sortByDesc('total_penjualan')
            ->values();

        $totalTransaksi = $detailPenjualan
            ->pluck('id_pesanan')
            ->unique()
            ->count();

        $totalPenjualan = $detailPenjualan->sum('subtotal');

        //laporan bahan menipis

        $bahanMenipis = Bahan::whereColumn('stok', '<=', 'batas_min')
            ->orderBy('nama_bahan')
            ->get();

        //laporan hpp margin

        $daftarMenu = Menu::with(['resep.bahan'])
            ->orderBy('nama_menu')
            ->get();

        $laporanMargin = $daftarMenu->map(function ($menu) {

            $hpp = 0;

            foreach ($menu->resep as $resep) {
                if ($resep->bahan) {
                    $hpp += (float) $resep->takaran
                        * (float) $resep->bahan->harga_per_satuan;
                }
            }

            $hargaJual = (float) $menu->harga;

            return [
                'nama_menu' => $menu->nama_menu,
                'harga_jual' => $hargaJual,
                'hpp' => $hpp,
                'margin' => $hargaJual - $hpp,
                'jumlah_bahan' => $menu->resep->count(),
            ];
        });

        return view('manajer.laporan', compact(
            'tanggalMulai',
            'tanggalAkhir',
            'penjualanMenu',
            'totalTransaksi',
            'totalPenjualan',
            'bahanMenipis',
            'laporanMargin'
        ));
    }
}
