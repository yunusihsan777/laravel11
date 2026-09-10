<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LkeSatkerBukti extends Model
{
    use HasFactory;

    protected $table = 'lke_satker_bukti';

    protected $fillable = [
        'id_satker',
        'komponen_id',
        'sub_komponen_id',
        'kriteria_id',
        'kode_bukti',
        'buktidukung_id',
        'link_bukti_dukung',
        'tgl_pengisian',
        'tahun',
    ];

    public function kriteria()
    {
        return $this->belongsTo(LkeKriteria::class, 'kriteria_id', 'kode');
    }

    public function buktiDukungMaster()
    {
        return $this->belongsTo(LkeBuktidukung::class, 'buktidukung_id', 'id');
    }
}
