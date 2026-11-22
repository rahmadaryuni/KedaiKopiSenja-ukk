<?php

namespace App\Http\Controllers;

use App\Services\HargaBahanService;
use App\Models\Bahan;
use Illuminate\Http\JsonResponse;
use Throwable;

class HargaBahanController extends Controller
{
    public function sinkronisasi(HargaBahanService $service): JsonResponse
    {
        try {
            $tanggal = $service->sinkronisasi();

            return response()->json([
                'status' => true,
                'pesan' => 'Harga bahan berhasil diperbarui.',
                'diperbarui' => $tanggal,
                'jumlah_bahan' => Bahan::whereNotNull('kode_api')->count(),
            ]);

        } catch (Throwable $e) {

            return response()->json([
                'status' => false,
                'pesan' => 'API tidak bisa diakses. Harga terakhir tetap digunakan.',
                'jumlah_bahan_tersimpan' => Bahan::whereNotNull('kode_api')->count(),
                'tanggal_harga_terakhir' => Bahan::whereNotNull('harga_diperbarui')
                    ->max('harga_diperbarui'),
            ], 503);
        }
    }
}

