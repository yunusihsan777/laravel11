<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SasaranProgram extends Model
{
    use HasFactory;

    protected $table = 'sasaran_program';

    protected $fillable = [
        'kode_sp',
        'nama_sp',
        'id_satker',
        'is_crosscutting',
        'tahun',
    ];

    public function indikatorKinerjaPrograms()
    {
        return $this->hasMany(IndikatorKinerjaProgram::class, 'sasaran_program_id');
    }

    public function targetIkps()
    {
        return $this->hasMany(TargetIkp::class, 'sp_id');
    }
}
