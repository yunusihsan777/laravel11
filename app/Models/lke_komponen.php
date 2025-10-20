<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lke_komponen extends Model
{
    use HasFactory;
    protected $table = 'lke_komponen';
    
    public $timestamps = false; // kalau tabelmu tidak punya created_at & updated_at
    protected $fillable = [
        'id',
        'komponen',
        'bobot',
        'created_at',
        'updated_at',
    ];
}
