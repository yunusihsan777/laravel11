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
    Schema::create('lke_komponen', function (Blueprint $table) {
    $table->id(); // bigint unsigned auto_increment primary key
    $table->string('komponen', 255);
    $table->integer('bobot'); // angka, bukan autoIncrement
    $table->timestamps();
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
