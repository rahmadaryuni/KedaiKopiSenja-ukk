<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'manajer'],
            [
                'nama' => 'manajersenja',
                'password' => Hash::make('manajer123'),
                'role' => 'manajer',
            ]
        );

        User::updateOrCreate(
            ['username' => 'kasir'],
            [
                'nama' => 'kasirsenja',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
            ]
        );
    }
}
