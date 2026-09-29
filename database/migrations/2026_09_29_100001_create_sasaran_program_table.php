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
        Schema::create('sasaran_program', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sp', 20)->comment('Misal: SP 1, SP 3, SP 13');
            $table->text('nama_sp')->comment('Nama Sasaran Program');
            $table->string('id_satker', 10)->comment('FK ke satker pengampu utama');
            $table->tinyInteger('is_crosscutting')->default(0)->comment('1 jika SP dimiliki >1 bidang');
            $table->string('tahun', 4);
            $table->timestamps();

            $table->unique(['kode_sp', 'id_satker', 'tahun'], 'uq_sp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sasaran_program');
    }
};
