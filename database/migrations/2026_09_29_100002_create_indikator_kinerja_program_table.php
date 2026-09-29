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
        Schema::create('indikator_kinerja_program', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sasaran_program_id')->constrained('sasaran_program')->onDelete('cascade');
            $table->string('kode_ikp', 20)->comment('Misal: IKP 13.1, IKP 3.2');
            $table->text('nama_ikp')->comment('Nama Indikator Kinerja Program');
            $table->string('id_satker', 10)->comment('FK ke satker pengampu');
            $table->string('sifat_node', 30)->default('AVERAGE')->comment('AVERAGE, RATIO_PERCENTAGE, INDEX_SCORE, DIRECT_INPUT');
            $table->string('tahun', 4);
            $table->timestamps();

            $table->unique(['kode_ikp', 'id_satker', 'tahun'], 'uq_ikp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_kinerja_program');
    }
};
