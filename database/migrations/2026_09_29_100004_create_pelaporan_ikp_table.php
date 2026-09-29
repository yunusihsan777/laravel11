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
        Schema::create('pelaporan_ikp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ikp_id')->constrained('indikator_kinerja_program')->onDelete('cascade');
            $table->string('id_satker', 10)->comment('Satker bidang pengampu');
            $table->string('tahun', 4);
            $table->tinyInteger('triwulan')->comment('1=TW1, 2=TW2, 3=TW3, 4=TW4');
            $table->text('faktor')->nullable()->comment('Faktor-faktor yang mempengaruhi capaian kinerja');
            $table->text('langkah_optimalisasi')->nullable()->comment('Upaya optimalisasi kinerja');
            $table->timestamps();

            $table->unique(['ikp_id', 'id_satker', 'tahun', 'triwulan'], 'uq_pelaporan_ikp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporan_ikp');
    }
};
