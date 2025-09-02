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
            $table->id();
            $table->char('id_komponen',3);
            $table->string('subkomponen',255);
            $table->integer('bobot',3);
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
