<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinoriSakipPidumDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinori_sakip_pidum_detail', function (Blueprint $table) {
            $table->id(); // Menggunakan auto increment untuk id_detail
            $table->string('id_program', 50);
            $table->char('id_satker', 10);
            $table->text('indikator');
            $table->tinyInteger('bulan');
            $table->decimal('ditangani', 5, 2)->nullable();
            $table->decimal('diselesaikan', 5, 2)->nullable();
            $table->integer('id_indikator')->nullable(); // Sesuaikan dengan tipe INT dari kolom id di sinori_sakip_indikator
            $table->foreign('id_program')->references('id_program')->on('sinori_sakip_pidum')->onDelete('cascade');
            $table->foreign('id_satker')->references('id_satker')->on('sinori_sakip_pidum')->onDelete('cascade');
            $table->foreign('id_indikator')->references('id')->on('sinori_sakip_indikator')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinori_sakip_pidum_detail');
    }
}
