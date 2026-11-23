<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('pesanan', 'nomor_meja')) {
            Schema::table('pesanan', function (Blueprint $table) {
                $table->string('nomor_meja')->nullable()->after('id_pelanggan');
            });
        }

        if (!Schema::hasColumn('pesanan', 'metode_pembayaran')) {
            Schema::table('pesanan', function (Blueprint $table) {
                $table->enum('metode_pembayaran', ['QRIS', 'Tunai'])
                    ->nullable()
                    ->after('nomor_meja');
            });
        }
    }

    public function down(): void
    {
        // Tidak menghapus kolom yang mungkin sudah ada sebelumnya.
    }
};