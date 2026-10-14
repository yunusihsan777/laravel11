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
        // 1. Tambahkan kolom langkah_kerja pada tabel kriteria jika ada
        if (Schema::hasTable('kriteria') && !Schema::hasColumn('kriteria', 'langkah_kerja')) {
            Schema::table('kriteria', function (Blueprint $table) {
                $table->text('langkah_kerja')->nullable()->after('nama_kriteria');
            });
        }

        // 2. Tambahkan kolom langkah_kerja pada tabel lke_kriteria jika ada
        if (Schema::hasTable('lke_kriteria') && !Schema::hasColumn('lke_kriteria', 'langkah_kerja')) {
            Schema::table('lke_kriteria', function (Blueprint $table) {
                $table->text('langkah_kerja')->nullable()->after('nama');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('kriteria') && Schema::hasColumn('kriteria', 'langkah_kerja')) {
            Schema::table('kriteria', function (Blueprint $table) {
                $table->dropColumn('langkah_kerja');
            });
        }

        if (Schema::hasTable('lke_kriteria') && Schema::hasColumn('lke_kriteria', 'langkah_kerja')) {
            Schema::table('lke_kriteria', function (Blueprint $table) {
                $table->dropColumn('langkah_kerja');
            });
        }
    }
};
