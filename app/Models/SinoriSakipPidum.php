<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinoriSakipPidum extends Model
{
    use HasFactory;
    protected $table = 'sinori_sakip_pidum';

    protected $fillable = [
        'id_indikator',
        'id_satker',
        'target_indikator',
        'indikator',
        'id_tahun',
    ];

    // Nonaktifkan timestamps
    public $timestamps = false;
    // Definisikan ID indikator sebagai konstanta
    const INDICATOR_IDS = [22, 23, 24, 25];

    public static function getData($idSatker, $tahun)
    {
        return self::whereIn('id_indikator', self::INDICATOR_IDS)
            ->where('id_satker', $idSatker)
            ->where('id_tahun', $tahun)
            ->get()
            ->keyBy('id_indikator');
    }
    // Anda dapat menambahkan relasi jika perlu
    // Misalnya, jika ada relasi dengan model lain, Anda bisa mendefinisikannya di sini
}
