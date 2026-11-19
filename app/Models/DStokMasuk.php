<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DStokMasuk extends Model
{
    protected $table = 'detail_stok_masuk';

    protected $primaryKey = 'id_detail_stok';

    public $timestamps = false;

    protected $fillable = [
        'id_stok_masuk',
        'id_bahan',
        'jumlah',
        'harga_stok',
    ];

    public function stokMasuk()
    {
        return $this->belongsTo(
            StokMasuk::class,
            'id_stok_masuk',
            'id_stok_masuk'
        );
    }

    public function bahan()
    {
        return $this->belongsTo(
            Bahan::class,
            'id_bahan',
            'id_bahan'
        );
    }
}

