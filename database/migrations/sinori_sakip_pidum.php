<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinoriSakipPidumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinori_sakip_pidum', function (Blueprint $table) {
            $table->id(); // Ini membuat kolom 'id' auto-increment
            $table->unsignedBigInteger('id_indikator');
            $table->unsignedBigInteger('id_satker');
            $table->decimal('target_indikator', 5, 2); // Misalnya ini adalah nilai persentase
            $table->timestamps(false); // Nonaktifkan created_at dan updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinori_sakip_pidum');
    }
}
