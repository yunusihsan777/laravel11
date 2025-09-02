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
        Schema::create('lke_kriteria', function (Blueprint $table) {
            $table->id();
            $table->char('id_komponen',3);
            $table->char('id_subkomponen',3);
            $table->char('range_nilai',3);
            $table->string('bentuk_bukti',255);
            $table->integer('bobot',3);
            $table->string('kriteria',255);
            
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
