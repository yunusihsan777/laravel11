<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LkeParameter extends Model
{
    protected $table = 'lke_parameter';

    protected $fillable = [
        'kriteria_id',
        'nilai',
        'skor',
        'keterangan',
        'tahun',
    ];

    public function kriteria()
    {
        return $this->belongsTo(LkeKriteria::class, 'kriteria_id', 'kode');
    }
}
