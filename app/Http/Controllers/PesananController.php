<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Menu;
use App\Models\Resep;
use App\Models\Bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PesananController extends Controller
{
    // Menampilkan data pesanan (API)
    public function index()
    {
        return Pesanan::with([
            'pelanggan',
            'detailPesanan.menu'
        ])->latest('tanggal_pesanan')->get();
    }

    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'detail' => 'required|array|min:1',
            'detail.*.id_menu' => 'required|exists:menu,id_menu',
            'detail.*.jumlah' => 'required|integer|min:1',
            'id_pelanggan' => 'nullable|exists:pelanggan,id_pelanggan',
            'nomor_meja' => 'required|string|max:50',
            'metode_pembayaran' => 'required|in:QRIS,Tunai',
        ]);

        return DB::transaction(function () use ($request) {

            $subtotal = 0;
            $details = [];

            foreach ($request->detail as $item) {
                $menu = Menu::findOrFail($item['id_menu']);

                if (!in_array($menu->status_menu, ['Aktif', 'Tersedia'])) {
                    throw ValidationException::withMessages([
                        'menu' => [$menu->nama_menu . ' sedang tidak bisa dipesan.']
                    ]);
                }

                $harga = (float) $menu->harga;
                $jumlah = (int) $item['jumlah'];
                $total = $harga * $jumlah;

                $subtotal += $total;

                $details[] = [
                    'id_menu' => $menu->id_menu,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $harga,
                    'subtotal' => $total,
                ];
            }

            // Hitung kebutuhan bahan berdasarkan resep
            $kebutuhan = $this->hitungKebutuhanBahan($details);

            // Kunci stok bahan
            $bahans = Bahan::whereIn(
                'id_bahan',
                array_keys($kebutuhan)
            )->lockForUpdate()->get()->keyBy('id_bahan');

            // Periksa stok bahan
            foreach ($kebutuhan as $idBahan => $jumlah) {
                $bahan = $bahans->get($idBahan);

                if (!$bahan || (float) $bahan->stok < $jumlah) {
                    throw ValidationException::withMessages([
                        'stok' => [
                            'Stok bahan ' .
                            ($bahan->nama_bahan ?? $idBahan) .
                            ' tidak mencukupi.'
                        ]
                    ]);
                }
            }

            // Hitung total pembayaran
            $biayaLayanan = $subtotal * 0.05;
            $pajak = ($subtotal + $biayaLayanan) * 0.10;
            $totalHarga = $subtotal + $biayaLayanan + $pajak;

            // Simpan pesanan
            $pesanan = Pesanan::create([
                'id_pelanggan' => $request->input('id_pelanggan') ?: null,
                'nomor_meja' => $request->nomor_meja,
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal_pesanan' => now(),
                'status_pesanan' => 'Baru',
                'subtotal' => $subtotal,
                'biaya_layanan' => $biayaLayanan,
                'pajak' => $pajak,
                'total_harga' => $totalHarga,
            ]);

            // Simpan detail pesanan
            foreach ($details as $detail) {
                $pesanan->detailPesanan()->create($detail);
            }

            // Kurangi stok bahan
            foreach ($kebutuhan as $idBahan => $jumlah) {
                $bahan = $bahans->get($idBahan);
                $bahan->stok = (float) $bahan->stok - $jumlah;
                $bahan->save();
            }

            // Respons untuk API
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Pesanan berhasil dibuat',
                    'data' => $pesanan->load(
                        'detailPesanan.menu',
                        'pelanggan'
                    )
                ], 201);
            }

            // Respons untuk halaman kasir
            return redirect()
                ->route('kasir.pesanan')
                ->with('success', 'Pesanan berhasil dibuat!');
        });
    }

        // Membuat pesanan dari aplikasi mobile pelanggan
        public function storeMobile(Request $request)
        {
           $request->validate([
                'detail' => 'required|array|min:1',
                'detail.*.id_menu' => 'required|exists:menu,id_menu',
                'detail.*.jumlah' => 'required|integer|min:1',
                'nomor_meja' => 'nullable|string|max:50',
                'metode_pembayaran' => 'nullable|in:QRIS,Tunai',
            ]);

            $pelanggan = $request->user();

            return DB::transaction(function () use ($request, $pelanggan) {

                $subtotal = 0;
                $details = [];

                foreach ($request->detail as $item) {
                    $menu = Menu::findOrFail($item['id_menu']);

                    if (!in_array($menu->status_menu, ['Aktif', 'Tersedia'])) {
                        throw ValidationException::withMessages([
                            'menu' => [$menu->nama_menu . ' sedang tidak tersedia.']
                        ]);
                    }

                    $harga = (float) $menu->harga;
                    $jumlah = (int) $item['jumlah'];
                    $total = $harga * $jumlah;

                    $subtotal += $total;

                    $details[] = [
                        'id_menu' => $menu->id_menu,
                        'jumlah' => $jumlah,
                        'harga_satuan' => $harga,
                        'subtotal' => $total,
                    ];
                }

                $kebutuhan = $this->hitungKebutuhanBahan($details);

                $bahans = Bahan::whereIn('id_bahan', array_keys($kebutuhan))
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id_bahan');

                foreach ($kebutuhan as $idBahan => $jumlah) {
                    $bahan = $bahans->get($idBahan);

                    if (!$bahan || (float) $bahan->stok < $jumlah) {
                        throw ValidationException::withMessages([
                            'stok' => [
                                'Stok bahan ' . ($bahan->nama_bahan ?? $idBahan)
                                . ' tidak mencukupi.'
                            ]
                        ]);
                    }
                }

                $biayaLayanan = $subtotal * 0.05;
                $pajak = ($subtotal + $biayaLayanan) * 0.10;
                $totalHarga = $subtotal + $biayaLayanan + $pajak;

                $pesanan = Pesanan::create([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'nomor_meja' => $request->nomor_meja,
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal_pesanan' => now(),
                'status_pesanan' => 'Baru',
                'subtotal' => $subtotal,
                'biaya_layanan' => $biayaLayanan,
                'pajak' => $pajak,
                'total_harga' => $totalHarga,
            ]);

                foreach ($details as $detail) {
                    $pesanan->detailPesanan()->create($detail);
                }

                foreach ($kebutuhan as $idBahan => $jumlah) {
                    $bahan = $bahans->get($idBahan);
                    $bahan->stok = (float) $bahan->stok - $jumlah;
                    $bahan->save();
                }

                return response()->json([
                    'message' => 'Pesanan berhasil dibuat.',
                    'data' => $pesanan->load('detailPesanan.menu')
                ], 201);
            });
        }


            // Riwayat pesanan milik pelanggan mobile
            public function riwayatMobile(Request $request)
            {
                $pelanggan = $request->user();

                $pesanan = Pesanan::with('detailPesanan.menu')
                    ->where('id_pelanggan', $pelanggan->id_pelanggan)
                    ->latest('tanggal_pesanan')
                    ->get();

                return response()->json([
                    'message' => 'Riwayat pesanan berhasil diambil.',
                    'data' => $pesanan
                ]);
            }


            // Detail satu pesanan (API)
            public function show($id)
            {
                return Pesanan::with([
                    'pelanggan',
                    'detailPesanan.menu'
                ])->findOrFail($id);
            }

            // Memperbarui status pesanan
            public function updateStatus(Request $request, $id)
            {
                $request->validate([
                    'status_pesanan' => 'required|in:Diproses,Selesai',
                ]);

                $pesanan = Pesanan::findOrFail($id);

                $urutan = [
                    'Baru' => 1,
                    'Diproses' => 2,
                    'Selesai' => 3,
                ];

                $sekarang = $urutan[$pesanan->status_pesanan] ?? 0;
                $berikutnya = $urutan[$request->status_pesanan];

                if ($berikutnya !== $sekarang + 1) {
                    return back()->with(
                        'error',
                        'Status pesanan harus berurutan.'
                    );
                }

                $pesanan->update([
                    'status_pesanan' => $request->status_pesanan
                ]);

                return back()->with(
                    'success',
                    'Status pesanan berhasil diperbarui!'
                );
            }

            // Membatalkan pesanan dan mengembalikan stok
            public function batal($id)
            {
                return DB::transaction(function () use ($id) {

                    $pesanan = Pesanan::where('id_pesanan', $id)
                        ->lockForUpdate()
                        ->firstOrFail();

                    if ($pesanan->status_pesanan !== 'Baru') {
                        return back()->with(
                            'error',
                            'Hanya pesanan berstatus Baru yang bisa dibatalkan.'
                        );
                    }

                    $pesanan->load('detailPesanan');

                    $details = $pesanan->detailPesanan->map(function ($detail) {
                        return [
                            'id_menu' => $detail->id_menu,
                            'jumlah' => $detail->jumlah,
                        ];
                    })->toArray();

                    $kebutuhan = $this->hitungKebutuhanBahan($details);

                    $bahans = Bahan::whereIn(
                        'id_bahan',
                        array_keys($kebutuhan)
                    )->lockForUpdate()->get()->keyBy('id_bahan');

                    // Kembalikan stok bahan
                    foreach ($kebutuhan as $idBahan => $jumlah) {
                        $bahan = $bahans->get($idBahan);

                        if (!$bahan) {
                            throw ValidationException::withMessages([
                                'stok' => [
                                    'Bahan untuk pesanan tidak ditemukan.'
                                ]
                            ]);
                        }

                        $bahan->stok = (float) $bahan->stok + $jumlah;
                        $bahan->save();
                    }

                    $pesanan->update([
                        'status_pesanan' => 'Dibatalkan'
                    ]);

                    return back()->with(
                        'success',
                        'Pesanan dibatalkan dan stok berhasil dikembalikan!'
                    );
                });
            }

            // Menghitung kebutuhan bahan berdasarkan resep
            private function hitungKebutuhanBahan(array $details)
            {
                $kebutuhan = [];

                foreach ($details as $detail) {
                    $resep = Resep::where(
                        'id_menu',
                        $detail['id_menu']
                    )->get();

                    if ($resep->isEmpty()) {
                        throw ValidationException::withMessages([
                            'resep' => [
                                'Resep menu ID ' .
                                $detail['id_menu'] .
                                ' belum tersedia.'
                            ]
                        ]);
                    }

                    foreach ($resep as $item) {
                        $idBahan = $item->id_bahan;

                        $kebutuhan[$idBahan] =
                            ($kebutuhan[$idBahan] ?? 0) +
                            (
                                (float) $item->takaran *
                                (int) $detail['jumlah']
                            );
                    }
                }

                return $kebutuhan;
            }

            // Halaman daftar pesanan kasir
            public function halamanKasir()
            {
                $pesanan = Pesanan::with([
                    'pelanggan',
                    'detailPesanan.menu'
                ])
                    ->latest('tanggal_pesanan')
                    ->get();

                return view('kasir.pesanan', compact('pesanan'));
            }

                public function strukKasir($id)
                {
                    $pesanan = Pesanan::with([
                        'pelanggan',
                        'detailPesanan.menu'
                    ])->findOrFail($id);

                    return view('kasir.struk', compact('pesanan'));
                }
                    }
