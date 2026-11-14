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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->datetime('tanggal_pesanan');
            $table->string('status_pesanan');
            $table->decimal('subtotal',12,2);
            $table->decimal('biaya_layanan',12,2);
            $table->decimal('pajak',12,2);
            $table->decimal('total_harga',12,2);

            $table->foreign('id_pelanggan')
            ->references('id_pelanggan')
            ->on('pelanggan');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
