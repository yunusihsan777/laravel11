<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'sinori_login'; 
    protected $fillable = [
        'id_satker', 'satkernama', 'satkerpass',
    ];

    protected $hidden = [
        'satkerpass',
    ];

    // Jika Anda menggunakan ID yang bukan auto-increment, tentukan ini
    protected $primaryKey = 'id_satker';
}
