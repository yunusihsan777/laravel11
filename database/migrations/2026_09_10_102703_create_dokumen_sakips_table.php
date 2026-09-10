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
        Schema::create('dokumen_sakips', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->comment('Misal: pedoman, template_2026, arsip_2025');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('url');
            $table->string('icon')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_sakips');
    }
};
