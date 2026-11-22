<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Bahan;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class ImportDataController extends Controller
{
    public function index()
    {
        return view('manajer.import-data');
    }

    public function import(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:menu,bahan,resep',
            'file' => 'required|file|mimes:csv,txt|max:5120',
        ]);

        $rows = $this->bacaCsv(
            $request->file('file')->getRealPath()
        );

        if (empty($rows)) {
            return back()->with('error', 'File CSV kosong atau formatnya tidak sesuai.');
        }

        $berhasil = 0;
        $dilewati = 0;
        $errors = [];

        foreach ($rows as $index => $row) {
            $nomorBaris = $index + 2;

            try {
                DB::transaction(function () use (
                    $request,
                    $row,
                    &$berhasil,
                    &$dilewati,
                    &$errors,
                    $nomorBaris
                ) {
                    $hasil = match ($request->jenis) {
                        'menu' => $this->importMenu($row),
                        'bahan' => $this->importBahan($row),
                        'resep' => $this->importResep($row),
                    };

                    if ($hasil === true) {
                        $berhasil++;
                    } else {
                        $dilewati++;
                        $errors[] = "Baris {$nomorBaris}: {$hasil}";
                    }
                });
            } catch (Throwable $e) {
                $dilewati++;
                $errors[] = "Baris {$nomorBaris}: Data gagal diproses.";
            }
        }

        return back()->with('hasil_import', [
            'jenis' => ucfirst($request->jenis),
            'berhasil' => $berhasil,
            'dilewati' => $dilewati,
            'errors' => array_slice($errors, 0, 20),
        ]);
    }

    private function bacaCsv($path)
    {
        $handle = fopen($path, 'r');

        if (!$handle) {
            return [];
        }

        $header = fgetcsv($handle, 0, ',', '"', '');

        if (!$header) {
            fclose($handle);
            return [];
        }

        // Menghapus BOM jika ada
        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);

        $header = array_map(
            fn ($item) => strtolower(trim($item)),
            $header
        );

        $rows = [];

        while (($data = fgetcsv($handle, 0, ',', '"', '')) !== false) {
            if (count($data) !== count($header)) {
                continue;
            }

            if (count(array_filter($data, fn ($value) => trim((string) $value) !== '')) === 0) {
                continue;
            }

            $rows[] = array_combine($header, $data);
        }

        fclose($handle);

        return $rows;
    }

    private function importMenu($row)
    {
        $kode = trim($row['kode'] ?? '');
        $nama = trim($row['nama_menu'] ?? '');
        $kategoriNama = trim($row['kategori'] ?? '');
        $harga = $row['harga_jual'] ?? null;

        if ($kode === '' || $nama === '' || $kategoriNama === '') {
            return 'Kode, nama menu, atau kategori kosong.';
        }

        if (!is_numeric($harga) || $harga < 0) {
            return 'Harga menu tidak valid.';
        }

        $kategori = DB::table('kategori')
            ->whereRaw('LOWER(TRIM(nama_kategori)) = ?', [
                Str::lower($kategoriNama)
            ])
            ->first();

        if (!$kategori) {
            return "Kategori {$kategoriNama} belum tersedia.";
        }

        $menu = Menu::where('kode_menu', $kode)->first();

        if (!$menu) {
            $menu = new Menu();
            $menu->kode_menu = $kode;
            $menu->status_menu = 'Aktif';
        }

        $menu->id_kategori = $kategori->id_kategori;
        $menu->nama_menu = $nama;
        $menu->deskripsi = null;
        $menu->harga = $harga;
        $menu->save();

        return true;
    }

    
        private function importBahan($row)
        {
            $kode = trim($row['kode'] ?? '');
            $nama = preg_replace('/\s+/', ' ', trim($row['nama_bahan'] ?? ''));
            $stok = $row['stok_awal'] ?? null;
            $satuan = strtolower(trim($row['satuan'] ?? ''));
            $harga = $row['harga_per_satuan'] ?? null;

            if ($nama === '' || !is_numeric($stok) || !is_numeric($harga)) {
                return 'Nama, stok, atau harga bahan tidak valid.';
            }

            if ($stok < 0 || $harga < 0) {
                return 'Stok dan harga tidak boleh negatif.';
            }

            $pengali = match ($satuan) {
                'kg', 'liter' => 1000,
                'g', 'ml', 'pcs' => 1,
                default => null,
            };

            if ($pengali === null) {
                return "Satuan {$satuan} tidak dikenal.";
            }

            $satuanDasar = match ($satuan) {
                'kg' => 'g',
                'liter' => 'ml',
                default => $satuan,
            };

            $stokDasar = (float) $stok * $pengali;
            $hargaDasar = (float) $harga / $pengali;

            $bahan = null;

            if ($kode !== '') {
                $bahan = Bahan::where('kode_api', $kode)->first();
            }

            if (!$bahan) {
                $bahan = Bahan::whereRaw(
                    'LOWER(TRIM(nama_bahan)) = ?',
                    [Str::lower($nama)]
                )->first();
            }

            $bahanBaru = !$bahan;

            if ($bahan && $kode !== '' && $bahan->kode_api && $bahan->kode_api !== $kode) {
                return "Bahan {$nama} sudah terdaftar dengan kode API berbeda.";
            }

            if (!$bahan) {
                $bahan = new Bahan();
            }

            if ($kode !== '') {
                $bahan->kode_api = $kode;
            }

            $bahan->nama_bahan = $nama;
            $bahan->satuan_dasar = $satuanDasar;

            // Stok hanya diisi saat bahan baru dibuat.
            if ($bahanBaru) {
                $bahan->stok = $stokDasar;
                $bahan->batas_min = 0;
            }

            $bahan->harga_per_satuan = $hargaDasar;
            $bahan->save();

            return true;
        }


    private function importResep($row)
    {
        $kodeMenu = trim($row['kode_menu'] ?? '');
        $namaBahan = trim($row['nama_bahan'] ?? '');
        $takaran = $row['takaran'] ?? null;
        $satuan = strtolower(trim($row['satuan'] ?? ''));

        if ($kodeMenu === '' || $namaBahan === '' || !is_numeric($takaran)) {
            return 'Kode menu, nama bahan, atau takaran tidak valid.';
        }

        if ($takaran <= 0) {
            return 'Takaran harus lebih dari nol.';
        }

        $menu = Menu::where('kode_menu', $kodeMenu)->first();

        if (!$menu) {
            return "Menu dengan kode {$kodeMenu} tidak ditemukan.";
        }

        // Perbaikan typo dari CSV
        $namaNormal = Str::lower(trim($namaBahan));

        if ($namaNormal === 'biji kopi arabica') {
            $namaNormal = 'biji kopi arabika';
        }

        $bahan = Bahan::whereRaw(
            'LOWER(TRIM(nama_bahan)) = ?',
            [$namaNormal]
        )->first();

        if (!$bahan) {
            return "Bahan {$namaBahan} tidak terdaftar.";
        }

        // Pastikan satuan resep sesuai satuan dasar bahan
        if ($satuan !== $bahan->satuan_dasar) {
            return "Satuan {$satuan} tidak sesuai dengan bahan {$bahan->nama_bahan}.";
        }

        $resep = Resep::where('id_menu', $menu->id_menu)
            ->where('id_bahan', $bahan->id_bahan)
            ->first();

        if (!$resep) {
            $resep = new Resep();
            $resep->id_menu = $menu->id_menu;
            $resep->id_bahan = $bahan->id_bahan;
        }

        $resep->takaran = $takaran;
        $resep->save();

        return true;
    }
}

