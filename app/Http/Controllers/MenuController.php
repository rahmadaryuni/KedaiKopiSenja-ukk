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
    public function buatPesanan(){
    $menu = Menu::with(['kategori', 'resep.bahan'])->get();

    foreach ($menu as $item) {
        $item->status_stok = $this->cekStokMenu($item);
    }
    return view('kasir.buat-pesanan', compact('menu'));
    }

    public function halamanKasir()
    {
        $menu=Menu::with('kategori')->get();
        return view('kasir.menu',compact('menu'));
    }


    public function cekStokMenu($menu){
        if ($menu->resep->isEmpty()){
            return 'Belum ada resep';
        }
        foreach($menu->resep as $resep){
            if(!$resep->bahan||$resep->bahan->stok<$resep->takaran){
                return 'Habis';
            }
        }
        return 'Tersedia';
    }

    // API daftar menu untuk aplikasi pelanggan
    public function apiIndex()
    {
        $menu = Menu::with('kategori')
            ->whereIn('status_menu', ['Aktif', 'Tersedia'])
            ->orderBy('nama_menu')
            ->get();

        return response()->json([
            'message' => 'Daftar menu berhasil diambil.',
            'data' => $menu
        ]);
    }

    // API detail menu untuk pelanggan
    public function apiShow($id)
    {
        $menu = Menu::with('kategori')
            ->whereIn('status_menu', ['Aktif', 'Tersedia'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail menu berhasil diambil.',
            'data' => $menu
        ]);
}
}
