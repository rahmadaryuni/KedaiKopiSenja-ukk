<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index()
    {
        $bahan = Bahan::orderBy('nama_bahan')->get();

        return view('manajer.bahan', compact('bahan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'satuan_dasar' => 'required|string|max:50',
            'stok' => 'nullable|numeric|min:0',
            'batas_min' => 'nullable|numeric|min:0',
        ]);

        $data['stok'] = $data['stok'] ?? 0;
        $data['batas_min'] = $data['batas_min'] ?? 0;

        Bahan::create($data);

        return redirect()
            ->route('bahan.index')
            ->with('success', 'Bahan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $bahan = Bahan::findOrFail($id);

        $data = $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'satuan_dasar' => 'required|string|max:50',
            'stok' => 'nullable|numeric|min:0',
            'batas_min' => 'nullable|numeric|min:0',
        ]);

        $data['stok'] = $data['stok'] ?? 0;
        $data['batas_min'] = $data['batas_min'] ?? 0;

        $bahan->update($data);

        return redirect()
            ->route('bahan.index')
            ->with('success', 'Data bahan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bahan = Bahan::findOrFail($id);

        try {
            $bahan->delete();

            return redirect()
                ->route('bahan.index')
                ->with('success', 'Bahan berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('bahan.index')
                ->with('error', 'Bahan tidak bisa dihapus karena masih digunakan dalam data resep atau stok masuk.');
        }
    }
}
