<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lke_subkomponens extends Model
{
    use HasFactory;
    protected $table = 'lke_subkomponen';
    protected $fillable = [
        'id',
        'id_komponen',
        'subkomponen',
        'bobot',
        'created_at',
        'updated_at',
    ];
}
