<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LkeBuktidukung extends Model
{
    protected $table = 'lke_buktidukung';
    public $timestamps = false;

    protected $fillable = [
        'dokumen',
        'format_nama_file',
        'keterangan',
        'ada_di_sistem',
        'tabel_sumber',
        'tahun',
    ];

    public function gabungan()
    {
        return $this->hasMany(LkeGabungan::class, 'buktidukung_id', 'id');
    }

    public function satkerBukti()
    {
        return $this->hasMany(LkeSatkerBukti::class, 'buktidukung_id', 'id');
    }
}
