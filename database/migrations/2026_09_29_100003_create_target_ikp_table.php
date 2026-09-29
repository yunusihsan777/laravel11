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
        Schema::create('target_ikp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ikp_id')->nullable()->constrained('indikator_kinerja_program')->onDelete('cascade');
            $table->foreignId('sp_id')->nullable()->constrained('sasaran_program')->onDelete('cascade');
            $table->string('id_satker', 10);
            $table->string('tahun', 4);
            $table->decimal('target_tahun', 10, 2)->nullable()->comment('Target tahunan (%/skor)');
            $table->decimal('target_tw1', 10, 2)->nullable();
            $table->decimal('target_tw2', 10, 2)->nullable();
            $table->decimal('target_tw3', 10, 2)->nullable();
            $table->decimal('target_tw4', 10, 2)->nullable();
            $table->timestamps();

            $table->unique(['ikp_id', 'id_satker', 'tahun'], 'uq_target_ikp');
            $table->index(['sp_id', 'id_satker', 'tahun'], 'idx_target_sp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_ikp');
    }
};
