<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ss_laporanapp extends Model
{
    use HasFactory;
    protected $table = 'ss_laporanapp';
    protected $fillable = [
        'no',
        'id_satker',
        'id_periode',
        'id_perubahan',
        'id_filename',
        'id_tglupload'
    ];
}
