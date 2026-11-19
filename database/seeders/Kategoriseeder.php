<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori')->updateOrInsert(
            ['kode_kategori' => 'DRINK'],
            ['nama_kategori' => 'Minuman']
        );

        DB::table('kategori')->updateOrInsert(
            ['kode_kategori' => 'FOOD'],
            ['nama_kategori' => 'Makanan']
        );
    }
}