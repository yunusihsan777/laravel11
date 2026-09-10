<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LkePenilaianSatker extends Model
{
    use HasFactory;

    protected $table = 'lke_penilaian_satker';

    protected $fillable = [
        'id_satker',
        'tahun',
        'komponen_id',
        'subkomponen_id',
        'kriteria_id',
        'parameter_id',
        'nilai',
        'skor',
        'catatan',
        'evaluator_id',
    ];

    public function kriteria()
    {
        return $this->belongsTo(LkeKriteria::class, 'kriteria_id', 'kode');
    }

    public function parameter()
    {
        return $this->belongsTo(LkeParameter::class, 'parameter_id', 'id');
    }
}
