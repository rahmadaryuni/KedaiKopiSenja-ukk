<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id('id_detail_pesanan');
            $table->unsignedBigInteger('id_pesanan');
            $table->unsignedBigInteger('id_menu');
            $table->Integer('jumlah');
            $table->decimal('harga_satuan',12,2);
            $table->decimal('subtotal',12,2);

            $table->foreign('id_pesanan')
            ->references('id_pesanan')
            ->on('pesanan');

            $table->foreign('id_menu')
            ->references('id_menu')
            ->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};
