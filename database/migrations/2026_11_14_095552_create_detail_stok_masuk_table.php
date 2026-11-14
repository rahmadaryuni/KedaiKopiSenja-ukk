<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_stok_masuk', function (Blueprint $table) {
            $table->id('id_detail_stok');
            $table->unsignedBigInteger('id_stok_masuk');
            $table->unsignedBigInteger('id_bahan');
            $table->decimal('jumlah', 12, 2);
            $table->decimal('harga_stok', 12, 2);

            $table->foreign('id_stok_masuk')
                ->references('id_stok_masuk')
                ->on('stok_masuk');

            $table->foreign('id_bahan')
                ->references('id_bahan')
                ->on('bahan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_stok_masuk');
    }
};