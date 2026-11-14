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
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu');
            $table->unsignedBigInteger('id_kategori');
            $table->string('nama_menu');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 2);
            $table->string('status_menu');

            $table->foreign('id_kategori')
            ->references('id_kategori')
            ->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
