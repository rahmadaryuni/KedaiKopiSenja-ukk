<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{
    protected $table = 'stok_masuk';

    protected $primaryKey = 'id_stok_masuk';

    public $timestamps = false;

    protected $fillable = [
        'id_manajer',
        'tanggal_masuk',
    ];

    public function detailStokMasuk()
    {
        return $this->hasMany(
            DStokMasuk::class,
            'id_stok_masuk',
            'id_stok_masuk'
        );
    }
}
