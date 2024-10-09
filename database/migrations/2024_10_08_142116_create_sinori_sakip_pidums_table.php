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
        Schema::create('sinori_sakip_pidums', function (Blueprint $table) {
            $table->id(); // Ini membuat kolom 'id' auto-increment
            $table->unsignedBigInteger('id_indikator');
            $table->unsignedBigInteger('id_satker');
            $table->decimal('target_indikator', 5, 2); // Misalnya ini adalah nilai persentase
            $table->timestamps(false); // Nonaktifkan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinori_sakip_pidums');
    }
};
