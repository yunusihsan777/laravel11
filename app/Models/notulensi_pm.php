<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notulensi_pm extends Model
{
    use HasFactory;
    protected $table = 'notulensi_pm';
    protected $fillable = [
        'no',
        'id_satker',
        'id_periode',
        'id_perubahan',
        'id_filename',
        'id_tglupload'
    ];
}
