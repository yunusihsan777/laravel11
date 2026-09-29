<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKinerjaProgram extends Model
{
    use HasFactory;

    protected $table = 'indikator_kinerja_program';

    protected $fillable = [
        'sasaran_program_id',
        'kode_ikp',
        'nama_ikp',
        'id_satker',
        'sifat_node',
        'tahun',
    ];

    public function sasaranProgram()
    {
        return $this->belongsTo(SasaranProgram::class, 'sasaran_program_id');
    }

    public function targetIkp()
    {
        return $this->hasOne(TargetIkp::class, 'ikp_id');
    }

    public function targetIkps()
    {
        return $this->hasMany(TargetIkp::class, 'ikp_id');
    }

    public function pelaporanIkps()
    {
        return $this->hasMany(PelaporanIkp::class, 'ikp_id');
    }

    public function pengukurans()
    {
        return $this->hasMany(Pengukuran::class, 'indikator_id')->where('khusus', 2);
    }
}
