<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Pelanggan extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'no_hp',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function pesanan()
    {
        return $this->hasMany(
            Pesanan::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
