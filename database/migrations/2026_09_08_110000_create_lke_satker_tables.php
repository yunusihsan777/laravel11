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
        // 1. Tabel Bukti Dukung Satker (Migrasi dari bukti_dukung lama dengan relasi lke)
        if (!Schema::hasTable('lke_satker_bukti')) {
            Schema::create('lke_satker_bukti', function (Blueprint $table) {
                $table->id();
                $table->string('id_satker', 50)->index();
                $table->string('komponen_id', 20)->nullable()->index();
                $table->string('sub_komponen_id', 20)->nullable()->index();
                $table->string('kriteria_id', 50)->index();
                $table->string('kode_bukti', 50)->nullable();
                $table->integer('buktidukung_id')->nullable()->index();
                $table->string('link_bukti_dukung', 255)->nullable();
                $table->string('tgl_pengisian', 100)->nullable();
                $table->unsignedSmallInteger('tahun')->nullable()->index();
                $table->timestamps();
            });
        }

        // 2. Tabel Penilaian Satker (Menyimpan hasil evaluasi per satker, kriteria & parameter)
        if (!Schema::hasTable('lke_penilaian_satker')) {
            Schema::create('lke_penilaian_satker', function (Blueprint $table) {
                $table->id();
                $table->string('id_satker', 50)->index();
                $table->unsignedSmallInteger('tahun')->index();
                $table->unsignedBigInteger('komponen_id')->nullable()->index();
                $table->string('subkomponen_id', 50)->nullable()->index();
                $table->string('kriteria_id', 50)->index();
                $table->unsignedBigInteger('parameter_id')->nullable()->index();
                $table->string('nilai', 50)->nullable();
                $table->double('skor', 8, 2)->default(0);
                $table->text('catatan')->nullable();
                $table->string('evaluator_id', 50)->nullable();
                $table->timestamps();

                $table->unique(['id_satker', 'tahun', 'kriteria_id'], 'satker_tahun_kriteria_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lke_penilaian_satker');
        Schema::dropIfExists('lke_satker_bukti');
    }
};
