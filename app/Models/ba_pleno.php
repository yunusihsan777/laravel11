<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ba_pleno extends Model
{
    use HasFactory;
    protected $table = 'ba_pleno';
    protected $fillable = [
        'no',
        'id_satker',
        'id_periode',
        'id_perubahan',
        'id_filename',
        'id_tglupload'
    ];
}
