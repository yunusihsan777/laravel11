<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LkeGabungan extends Model
{
    protected $table = 'lke_gabungan';
    public $timestamps = false;

    protected $fillable = [
        'komponen_id',
        'sub_komponen_id',
        'kriteria_id',
        'buktidukung_id',
        'tahun',
    ];

    public function buktidukung()
    {
        return $this->belongsTo(LkeBuktidukung::class, 'buktidukung_id', 'id');
    }

    public function kriteria()
    {
        return $this->belongsTo(LkeKriteria::class, 'kriteria_id', 'kode');
    }
}
