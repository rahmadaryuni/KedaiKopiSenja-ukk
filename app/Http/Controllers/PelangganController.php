<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    // Menampilkan data pelanggan
    public function index()
    {
        return Pelanggan::all();
    }

    // Reset password pelanggan oleh kasir
    
    public function resetPassword($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        // Membuat password sementara
        $passwordSementara = 'Senja' . random_int(1000, 9999);

        // Simpan password dalam bentuk hash
        $pelanggan->password = Hash::make($passwordSementara);

        // Wajib mengganti password saat login berikutnya
        $pelanggan->wajib_ganti_password = true;

        $pelanggan->save();

        // Logout semua perangkat yang pernah login
        $pelanggan->tokens()->delete();

        return response()->json([
            'message' => 'Password berhasil direset.',
            'password_sementara' => $passwordSementara,
        ]);
    }


    // Halaman pelanggan untuk kasir
    public function halamanKasir()
    {
        $pelanggan = Pelanggan::all();

        return view('kasir.pelanggan', compact('pelanggan'));
    }

    // Register pelanggan dari aplikasi mobile
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20|unique:pelanggan,no_hp',
            'password' => 'required|string|min:8',
        ]);

        $pelanggan = Pelanggan::create([
            'nama' => $validated['nama'],
            'no_hp' => $validated['no_hp'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $pelanggan->createToken('mobile-pelanggan')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil.',
            'pelanggan' => [
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'nama' => $pelanggan->nama,
                'no_hp' => $pelanggan->no_hp,
            ],
            'token' => $token,
        ], 201);
    }

    // Login pelanggan dari aplikasi mobile
    public function login(Request $request)
    {
        $validated = $request->validate([
            'no_hp' => 'required|string',
            'password' => 'required|string',
        ]);

        $pelanggan = Pelanggan::where('no_hp', $validated['no_hp'])->first();

        if (!$pelanggan || !Hash::check($validated['password'], $pelanggan->password)) {
            return response()->json([
                'message' => 'Nomor HP atau password salah.',
            ], 401);
        }

        $token = $pelanggan->createToken('mobile-pelanggan')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'pelanggan' => [
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'nama' => $pelanggan->nama,
            'no_hp' => $pelanggan->no_hp,
            'wajib_ganti_password' => (bool) $pelanggan->wajib_ganti_password,
        ],
            'token' => $token,
        ]);
    }

    public function profil(Request $request){
        $pelanggan= $request->user();

        return response()->json([
            'pelanggan'=>[
                'id_pelanggan'=>$pelanggan->id_pelanggan,
                'nama'=> $pelanggan->nama,
                'no_hp'=>$pelanggan->no_hp, 
                'wajib_ganti_password' => (bool) $pelanggan->wajib_ganti_password, 
            ],
        ]);
    }

    public function ubahPassword(Request $request)
    {
    $validated = $request->validate([
        'password_lama' => 'required|string',
        'password_baru' => 'required|string|min:8|confirmed',
    ]);

    $pelanggan = $request->user();

    if (!Hash::check($validated['password_lama'], $pelanggan->password)) {
        return response()->json([
            'message' => 'Password lama tidak sesuai.',
        ], 422);
    }

    $pelanggan->password = Hash::make($validated['password_baru']);
    $pelanggan->wajib_ganti_password = false;
    $pelanggan->save();

    return response()->json([
        'message' => 'Password berhasil diperbarui.',
    ]);
    }
}
