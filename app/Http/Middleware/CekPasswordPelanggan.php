<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekPasswordPelanggan
{
    public function handle(Request $request, Closure $next): Response
    {
        $pelanggan = $request->user();

        if ($pelanggan && $pelanggan->wajib_ganti_password) {
            return response()->json([
                'message' => 'Silakan ganti password sementara terlebih dahulu.',
                'wajib_ganti_password' => true,
            ], 403);
        }

        return $next($request);
    }
}
