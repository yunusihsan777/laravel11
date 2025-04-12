<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'sinori_login'; 
    protected $fillable = [
        'id_satker', 'satkernama', 'password',
    ];

    protected $hidden = [
        'satkerpass',
    ];

    // Jika Anda menggunakan ID yang bukan auto-increment, tentukan ini
    protected $primaryKey = 'id_satker';
    public $timestamps = false;

    
    public function keputusan()
    {
        return $this->hasOne(Kep::class, 'id_satker', 'id_satker');
    }

    public function renstra()
    {
        return $this->hasOne(Renstra::class, 'id_satker', 'id_satker');
    }

    public function renja()
    {
        return $this->hasOne(Renja::class, 'id_satker', 'id_satker');
    }

/*     public function penetapan()
    {
        return $this->hasOne(Penetapan::class, 'id_satker', 'id_satker');
    }
 */
    public function iku()
    {
        return $this->hasOne(Iku::class, 'id_satker', 'id_satker');
    }

    public function dipa()
    {
        return $this->hasOne(Dipa::class, 'id_satker', 'id_satker');
    }

    public function renaksi()
    {
        return $this->hasOne(Renaksi::class, 'id_satker', 'id_satker');
    }

    public function lakip()
    {
        return $this->hasOne(Lkjip::class, 'id_satker', 'id_satker');
    }
    public function getIku()
    {
        return $this->hasMany(Iku::class, 'id_satker', 'id_satker');
    }

    public function getDipa()
    {
        return $this->hasMany(Dipa::class, 'id_satker', 'id_satker');
    }
    public function getLakip()
    {
        return $this->hasMany(Lkjip::class, 'id_satker', 'id_satker');
    }

    public function getRenaksi()
    {
        return $this->hasMany(Renaksi::class, 'id_satker', 'id_satker');
    }
    public function getKeputusan()
    {
        return $this->hasMany(Kep::class, 'id_satker', 'id_satker');
    }

    public function getRenja()
    {
        return $this->hasMany(Renja::class, 'id_satker', 'id_satker');
    }
    public function getRenstra()
    {
        return $this->hasMany(Renstra::class, 'id_satker', 'id_satker');
    }


}
