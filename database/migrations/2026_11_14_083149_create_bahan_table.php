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
        Schema::create('bahan', function (Blueprint $table) {
            $table->id('id_bahan');
            $table->string('nama_bahan');
            $table->string('satuan_dasar');
            $table->decimal('stok', 12, 2)->default(0);
            $table->decimal('batas_min', 12, 2)->default(0);
            $table->unsignedBigInteger('id_harga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan');
    }
};
