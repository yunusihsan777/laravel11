<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renaksi extends Model
{
    use HasFactory;
    protected $table = 'sinori_sakip_renaksi';
    public $timestamps = false;

    protected $fillable = [
        'id_filename',
        'id_periode',
        'id_perubahan',
        'id_tglupload',
        'id_satker',
        // 'id_pagu',
        // 'id_gakyankum',
        // 'id_dukman',

    ];
}
