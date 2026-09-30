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
        Schema::table('pelaporan_ikp', function (Blueprint $table) {
            // Nilai realisasi langsung: persentase (misal 82.50) atau skor indeks (misal 3.75)
            $table->decimal('realisasi', 20, 2)->nullable()
                ->after('triwulan')
                ->comment('Nilai realisasi langsung: % atau skor indeks');

            // Kolom opsional untuk audit trail (tidak wajib diisi)
            $table->decimal('pembilang', 20, 2)->nullable()
                ->after('realisasi')
                ->comment('Opsional: angka pembilang untuk audit trail');
            $table->decimal('penyebut', 20, 2)->nullable()
                ->after('pembilang')
                ->comment('Opsional: angka penyebut untuk audit trail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelaporan_ikp', function (Blueprint $table) {
            $table->dropColumn(['realisasi', 'pembilang', 'penyebut']);
        });
    }
};
