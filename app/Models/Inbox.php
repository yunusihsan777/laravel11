<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'sinori_sakip_inbox'; // Nama tabel yang sesuai dengan database
    public $timestamps = false; // Jika tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'id',
        'judul',
        'isi',
        'tanggal',
        'tglpost'
    ];
}
