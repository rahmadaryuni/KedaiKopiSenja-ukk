<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('stok_masuk')) {
            Schema::create('stok_masuk', function (Blueprint $table) {
                $table->id('id_stok_masuk');
                $table->unsignedBigInteger('id_manajer');
                $table->date('tanggal_masuk');

                $table->foreign('id_manajer')
                    ->references('id')
                    ->on('users');
            });
        }
    }

    public function down(): void
    {
        //
    }
};