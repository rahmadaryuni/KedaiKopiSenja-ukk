<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->string('nomor_meja')->nullable()->after('status_pesanan');
            $table->string('metode_pembayaran')->nullable()->after('nomor_meja');
        });
    }

    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn(['nomor_meja', 'metode_pembayaran']);
        });
    }
};
