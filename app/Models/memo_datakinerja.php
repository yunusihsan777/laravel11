<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memo_datakinerja extends Model
{
    use HasFactory;
    protected $table = 'memo_datakinerja';
    protected $fillable = [
        'no',
        'id_satker',
        'id_periode',
        'id_perubahan',
        'id_filename',
        'id_tglupload'
    ];
}
