<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Menu;
use App\Models\Bahan;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function index()
    {
        $resep = Resep::with(['menu', 'bahan'])
            ->orderBy('id_menu')
            ->get();

        $menu = Menu::orderBy('nama_menu')->get();

        $bahan = Bahan::orderBy('nama_bahan')->get();

        return view('manajer.resep', compact(
            'resep',
            'menu',
            'bahan'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_menu' => 'required|exists:menu,id_menu',
            'id_bahan' => 'required|exists:bahan,id_bahan',
            'takaran' => 'required|numeric|gt:0',
        ]);

        Resep::create($data);

        return redirect()
            ->route('resep.index')
            ->with('success', 'Resep berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);

        $data = $request->validate([
            'id_menu' => 'required|exists:menu,id_menu',
            'id_bahan' => 'required|exists:bahan,id_bahan',
            'takaran' => 'required|numeric|gt:0',
        ]);

        $resep->update($data);

        return redirect()
            ->route('resep.index')
            ->with('success', 'Resep berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);

        $resep->delete();

        return redirect()
            ->route('resep.index')
            ->with('success', 'Resep berhasil dihapus.');
    }
}
