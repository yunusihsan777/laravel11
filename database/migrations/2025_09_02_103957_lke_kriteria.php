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
    $table->unsignedBigInteger('id_komponen');      // FK ke lke_komponen
    $table->char('id_subkomponen', 10);   // FK ke lke_subkomponen
    $table->string('range_nilai', 3);               // atau char(3) jika pasti fix 3 karakter
    $table->unsignedBigInteger('bentuk_bukti');
    $table->float('bobot');
    $table->text('kriteria', 255);
    $table->timestamps();

    // Foreign keys
    $table->foreign('id_komponen')
          ->references('id')
          ->on('lke_komponen')
          ->onDelete('cascade');

    $table->foreign('id_subkomponen')
          ->references('id')
          ->on('lke_subkomponen')
          ->onDelete('cascade');

/*     $table->foreign('bentuk_bukti')
          ->references('id')
          ->on('lke_buktidukung')
          ->onDelete('cascade');     */
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
