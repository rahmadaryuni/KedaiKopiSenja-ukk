<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan';
    protected $primaryKey = 'id_bahan';
    public $timestamps = false;

    protected $fillable = [
        'kode_api',
        'nama_bahan',
        'satuan_dasar',
        'stok',
        'batas_min',
        'id_harga',
        'harga_per_satuan',
        'harga_diperbarui'
    ];

    public function resep()
    {
        return $this->hasMany(Resep::class, 'id_bahan', 'id_bahan');
    }

    public function detailStokMasuk()
    {
        return $this->hasMany(
            DetailStokMasuk::class,
            'id_bahan',
            'id_bahan'
        );
    }
}
