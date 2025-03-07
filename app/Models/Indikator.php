<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'sinori_sakip_indikator';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_bidang',
        // 'tipe',
        'link',
        'lingkup',
        'indikator_nama',
        'indikator_pembilang',
        'indikator_penyebut',
        'indikator_penjelasan',
        'sub_indikator',
    ];

    // Jika tidak ada timestamps
    public $timestamps = false;

    // Relasi berdasarkan id_bidang
    public function bidangById()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id');
    }

    // Relasi berdasarkan link dan rumpun
    public function bidangByLink()
    {
        return $this->belongsTo(Bidang::class, 'link', 'rumpun');
    }
}
