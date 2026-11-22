<?php

namespace App\Services;

use App\Models\Bahan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class HargaBahanService
{
    public function sinkronisasi()
    {
        $response = Http::withHeaders([
            'X-API-Key' => config('services.kafe.key'),
            'Accept' => 'application/json',
        ])
        ->timeout(20)
        ->get(config('services.kafe.url'));

        $response->throw();

        $hasil = $response->json();

        if (
            !isset($hasil['data']) ||
            !is_array($hasil['data']) ||
            !isset($hasil['diperbarui'])
        ) {
            throw new Exception('Format data API tidak sesuai.');
        }

        DB::transaction(function () use ($hasil) {
            foreach ($hasil['data'] as $item) {
                $kode = trim($item['kode']);
                $nama = preg_replace('/\s+/', ' ', trim($item['nama']));

                $bahan = Bahan::where('kode_api', $kode)->first();

                if (!$bahan) {
                    $bahan = Bahan::whereRaw(
                        'LOWER(TRIM(nama_bahan)) = ?',
                        [Str::lower($nama)]
                    )->first();
                }

                if ($bahan && $bahan->kode_api && $bahan->kode_api !== $kode) {
                    throw new Exception(
                        "Bahan {$nama} sudah terdaftar dengan kode API berbeda."
                    );
                }

                if (!$bahan) {
                    $bahan = new Bahan();
                }

                $bahan->kode_api = $kode;
                $bahan->nama_bahan = $nama;
                $bahan->satuan_dasar = $item['satuan_dasar'];
                $bahan->harga_per_satuan = $item['harga_per_satuan'];
                $bahan->harga_diperbarui = $hasil['diperbarui'];

                // Stok tidak diubah oleh sinkronisasi harga.
                $bahan->save();
            }
        });

        return $hasil['diperbarui'];
    }
}
