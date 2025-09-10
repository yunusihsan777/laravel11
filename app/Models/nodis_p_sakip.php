<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nodis_p_sakip extends Model
{
    use HasFactory;
    protected $table = 'nodis_p_sakip';
    protected $fillable = [
        'no',
        'id_satker',
        'id_periode',
        'id_perubahan',
        'id_filename',
        'id_tglupload'
    ];
}
