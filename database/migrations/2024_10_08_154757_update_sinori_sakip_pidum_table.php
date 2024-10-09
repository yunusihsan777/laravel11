<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSinoriSakipPidumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sinori_sakip_pidum', function (Blueprint $table) {
            // Jika ingin menambahkan kolom baru, misalnya:
            // $table->string('new_column')->nullable();

            // Jika ingin mengubah kolom 'id' menjadi auto-increment,
            // Anda harus terlebih dahulu menghapus kolom yang ada dan menambahkannya kembali
            $table->dropPrimary('id'); // Menghapus primary key jika perlu
            $table->increments('id')->first(); // Menambahkan kolom id dengan auto-increment
            // Pastikan tidak ada data di tabel ini atau buat cadangan jika diperlukan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sinori_sakip_pidum', function (Blueprint $table) {
            // Tambahkan logika untuk rollback, misalnya:
            // $table->dropColumn('new_column');

            // Jika Anda ingin mengembalikan id menjadi semula
            $table->dropColumn('id');
            $table->bigIncrements('id')->first(); // Mengembalikan id seperti semula
        });
    }
}
