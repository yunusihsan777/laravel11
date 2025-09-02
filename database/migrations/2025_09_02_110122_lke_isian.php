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
        Schema::create('lke_isian', function (Blueprint $table) {
            $table->id();
            $table->char('id_satker',20);
            $table->char('id_komponen',3);
            $table->char('id_subkomponen',3);
            $table->char('id_kriteria',3);
            $table->integer('nilai',3);
            $table->string('bukti',255);
            $table->string('catatan',255);
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
