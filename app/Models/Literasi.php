<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Literasi extends Model
{
    protected $table = 'sinori_sakip_literasi'; // Nama tabel yang sesuai dengan database
    public $timestamps = false; // Jika tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'id',
        'id_namaproduk',
        'id_tahun',
        'id_produsen',
        'id_filename'
    ];
}
