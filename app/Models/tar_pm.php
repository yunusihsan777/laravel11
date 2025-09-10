<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tar_pm extends Model
{
    use HasFactory;
    protected $table = 'tar_pm';
    protected $fillable = [
        'no',
        'id_satker',
        'id_periode',
        'id_perubahan',
        'id_filename',
        'TW',
        'id_tglupload'
    ];
}
