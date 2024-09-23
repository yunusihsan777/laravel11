<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'sinori_sakip_inbox';
    
    protected $fillable = [
        'judul',
        'isi',
    ];
    const CREATED_AT = 'tanggal';
    const UPDATED_AT = 'tglpost';
}
