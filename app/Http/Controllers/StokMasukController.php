<?php

namespace App\Http\Controllers;

use App\Models\StokMasuk;
use App\Models\Bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokMasukController extends Controller
{
    public function index()
    {
        $stokMasuk = StokMasuk::with([
            'detailStokMasuk.bahan'
        ])
        ->orderByDesc('tanggal_masuk')
        ->orderByDesc('id_stok_masuk')
        ->get();

        $bahan = Bahan::orderBy('nama_bahan')->get();

        return view('manajer.stok', compact(
            'stokMasuk',
            'bahan'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal_masuk' => 'required|date',
            'id_bahan' => 'required|exists:bahan,id_bahan',
            'jumlah' => 'required|numeric|gt:0',
        ]);

        DB::transaction(function () use ($data) {

            $bahan = Bahan::where(
                'id_bahan',
                $data['id_bahan']
            )->lockForUpdate()->firstOrFail();

            $stokMasuk = StokMasuk::create([
                'id_manajer' => auth()->id(),
                'tanggal_masuk' => $data['tanggal_masuk'],
            ]);

            $stokMasuk->detailStokMasuk()->create([
                'id_bahan' => $bahan->id_bahan,
                'jumlah' => $data['jumlah'],
                'harga_stok' => 0,
            ]);

            $bahan->increment('stok', $data['jumlah']);
        });

        return redirect()
            ->route('stok-masuk.index')
            ->with('success', 'Pembelian berhasil dicatat dan stok bahan telah ditambahkan.');
    }

    public function show($id)
    {
        $stokMasuk = StokMasuk::with([
            'detailStokMasuk.bahan'
        ])->findOrFail($id);

        return response()->json($stokMasuk);
    }
}
