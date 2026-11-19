<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        return Pelanggan::all();
    }
    public function resetPassword($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $passwordSementara = 'Senja' . random_int(1000, 9999);

        $pelanggan->password = Hash::make($passwordSementara);
        $pelanggan->save();

        return response()->json([
        'message' => 'Password berhasil direset.',
        'password_sementara' => $passwordSementara,
        ]);

    }
    public function halamanKasir()
    {
    $pelanggan = Pelanggan::all();

    return view('kasir.pelanggan', compact('pelanggan'));
    }
}
