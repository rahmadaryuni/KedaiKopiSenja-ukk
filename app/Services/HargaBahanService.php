<?php

namespace App\Services;

use App\Models\Bahan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
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
                Bahan::updateOrCreate(
                    ['kode_api' => $item['kode']],
                    [
                        'nama_bahan' => $item['nama'],
                        'satuan_dasar' => $item['satuan_dasar'],
                        'harga_per_satuan' => $item['harga_per_satuan'],
                        'harga_diperbarui' => $hasil['diperbarui'],
                    ]
                );
            }
        });

        return $hasil['diperbarui'];
    }
}
