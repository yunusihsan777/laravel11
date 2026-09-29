<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetIkp extends Model
{
    use HasFactory;

    protected $table = 'target_ikp';

    protected $fillable = [
        'ikp_id',
        'sp_id',
        'id_satker',
        'tahun',
        'target_tahun',
        'target_tw1',
        'target_tw2',
        'target_tw3',
        'target_tw4',
    ];

    public function indikatorKinerjaProgram()
    {
        return $this->belongsTo(IndikatorKinerjaProgram::class, 'ikp_id');
    }

    public function sasaranProgram()
    {
        return $this->belongsTo(SasaranProgram::class, 'sp_id');
    }
}
