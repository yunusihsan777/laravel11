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
        Schema::create('lke_nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_satker');
            $table->unsignedBigInteger('id_komponen');
            $table->unsignedBigInteger('id_subkomponen');
            $table->unsignedBigInteger('id_kriteria');
            $table->float('nilai'); // atau smallInteger() jika nilai kecil
            $table->string('bukti', 255);
            $table->string('catatan', 255);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_komponen')
                  ->references('id')
                  ->on('lke_komponen')
                  ->onDelete('cascade');
                  
            $table->foreign('id_subkomponen')
                  ->references('id')
                  ->on('lke_subkomponen')
                  ->onDelete('cascade');

            $table->foreign('id_kriteria')
                  ->references('id')
                  ->on('lke_kriteria')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
