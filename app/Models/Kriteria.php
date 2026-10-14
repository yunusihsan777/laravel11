<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'id',
        'id_sub_komponen',
        'nama_kriteria',
        'langkah_kerja',
        'bukti_tulisan',
        'keterangan',
        'bukti_pengisian',
        'format_nama_file',
    ];
}
