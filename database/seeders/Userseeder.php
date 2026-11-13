<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class Userseeder extends Seeder
{
    
    public function run(): void
    {
        User::updateOrCreate( //kalau Seeder dijalankan lagi, Laravel tidak membuat akun dengan username yang sama
        ['username' => 'manajer'],
        [
            'nama' => 'manajersenja',
            'password' => 'manajer123',
            'role' => 'manajer',
            ]
        );
        User::updateOrCReate(
            ['username' => 'kasir'],
            [
                'nama' => 'kasirsenja',
                'password' => 'kasir123',
                'role' => 'kasir',
            ]
        );
    }
}
