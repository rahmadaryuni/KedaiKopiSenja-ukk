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
        Schema::create('resep', function (Blueprint $table) {
            $table->id('id_resep');
            $table->unsignedBigInteger('id_menu');
            $table->unsignedBigInteger('id_bahan');
            $table->decimal('takaran', 12,2);

            $table->foreign('id_menu')
            ->references('id_menu')
            ->on('menu');

            $table->foreign('id_bahan')
            ->references('id_bahan')
            ->on('bahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};
