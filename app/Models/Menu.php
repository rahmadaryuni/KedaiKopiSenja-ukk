<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $primaryKey = 'id_menu';

    public $timestamps = false;

    protected $fillable = [
        'kode_menu',
        'id_kategori',
        'nama_menu',
        'deskripsi',
        'harga',
        'status_menu'
    ];

    // Satu menu dimiliki oleh satu kategori
    public function kategori()
    {
        return $this->belongsTo(
            Kategori::class,
            'id_kategori',
            'id_kategori'
        );
    }

    // Satu menu dapat memiliki banyak resep
    public function resep()
    {
        return $this->hasMany(
            Resep::class,
            'id_menu',
            'id_menu'
        );
    }

    // Satu menu dapat muncul di banyak detail pesanan
    public function detailPesanan()
    {
        return $this->hasMany(
            DetailPesanan::class,
            'id_menu',
            'id_menu'
        );
    }
}

