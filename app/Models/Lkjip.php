<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lkjip extends Model
{
    use HasFactory;

    protected $table = 'lkjip';
    protected $fillable = [
        'id_satker',
        'id_periode',
        'triwulan',
        'id_perubahan',
        'id_filename',
        'id_tglupload',
    ];

    public $timestamps = false; // Nonaktifkan timestamps jika tidak menggunakan `created_at` dan `updated_at`
}
