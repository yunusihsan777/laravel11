<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanIkp extends Model
{
    use HasFactory;

    protected $table = 'pelaporan_ikp';

    protected $fillable = [
        'ikp_id',
        'id_satker',
        'tahun',
        'triwulan',
        'faktor',
        'langkah_optimalisasi',
    ];

    public function indikatorKinerjaProgram()
    {
        return $this->belongsTo(IndikatorKinerjaProgram::class, 'ikp_id');
    }
}
