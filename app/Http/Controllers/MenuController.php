<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::with('kategori')->get();
        $kategori = \App\Models\Kategori::all();

        return view('manajer.menu', compact('menu', 'kategori'));

    }

    //menambah menu baru
            public function store(Request $request)
        {
            $data = $request->validate([
                'id_kategori' => 'required|exists:kategori,id_kategori',
                'nama_menu' => 'required|string|max:100',
                'deskripsi' => 'nullable|string',
                'harga' => 'required|numeric|min:0',
                'status_menu' => 'required|string|max:30',
            ]);

            Menu::create($data);

            return redirect()->route('menu.index')
                ->with('success', 'Menu berhasil ditambahkan.');
        }

    //menu tampil berdasar id
    public function show($id)
    {
        $menu=Menu::with('kategori')->findOrFail($id);
        return response()->json($menu);
    }

    //mengubah data
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $data = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_menu' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'status_menu' => 'required|string|max:30',
        ]);

        $menu->update($data);

        return redirect()->route('menu.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    
    // Menghapus menu
    public function destroy($id)
    {
    $menu = Menu::findOrFail($id);
    $menu->delete();

    return redirect()->route('menu.index')
        ->with('success', 'Menu berhasil dihapus.');
    }


    // Halaman buat pesanan untuk kasir
    public function buatPesanan()
    {
        $menu = Menu::with('kategori')->get();

        return view('kasir.buat-pesanan', compact('menu'));
    }
    public function halamanKasir()
    {
        $menu=Menu::with('kategori')->get();
        return view('kasir.menu',compact('menu'));
    }
}
