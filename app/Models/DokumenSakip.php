<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenSakip extends Model
{
    use HasFactory;
    
    protected $table = 'dokumen_sakips';
    protected $fillable = ['kategori', 'judul', 'deskripsi', 'url', 'icon', 'urutan', 'is_active'];
}
