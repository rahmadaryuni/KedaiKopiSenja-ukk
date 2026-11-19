<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey= 'id_pelanggan';
    public $timestamps = false;

    protected $fillable=[
        'nama',
        'no_hp',
        'password',
    ];

    protected $hidden=[
        'password',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
