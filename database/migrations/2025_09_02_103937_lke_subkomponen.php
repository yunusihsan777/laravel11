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
Schema::create('lke_subkomponen', function (Blueprint $table) {
    $table->char('id', 10)->primary(); // atau $table->string('id', 10);
    $table->unsignedBigInteger('id_komponen'); // FK ke lke_komponen.id
    $table->string('subkomponen', 255);
    $table->float('bobot'); // cukup integer tanpa panjang
    $table->timestamps();

    // Kalau mau relasi FK
    $table->foreign('id_komponen')
          ->references('id')
          ->on('lke_komponen')
          ->onDelete('cascade'); // optional
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
