<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lke_subkomponens extends Model
{
    use HasFactory;
    protected $table = 'lke_subkomponen';
    
    public $timestamps = false; // kalau tabelmu tidak punya created_at & updated_at
    protected $fillable = [
        'id',
        'id_komponen',
        'subkomponen',
        'bobot',
        'created_at',
        'updated_at',
    ];
}
