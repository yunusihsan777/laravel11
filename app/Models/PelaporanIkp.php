<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanIkp extends Model
{
    use HasFactory;

    protected $table = 'pelaporan_ikp';

    protected $fillable = [
        'ikp_id',
        'id_satker',
        'tahun',
        'triwulan',
        'realisasi',
        'pembilang',
        'penyebut',
        'faktor',
        'langkah_optimalisasi',
    ];

    protected $casts = [
        'realisasi' => 'decimal:2',
        'pembilang' => 'decimal:2',
        'penyebut'  => 'decimal:2',
    ];

    public function indikatorKinerjaProgram()
    {
        return $this->belongsTo(IndikatorKinerjaProgram::class, 'ikp_id');
    }

    /**
     * Hitung capaian realisasi terhadap target triwulan.
     *
     * @return float|null Persentase capaian (misal: 103.13)
     */
    public function hitungCapaian(): ?float
    {
        $ikp = $this->indikatorKinerjaProgram;
        if (!$ikp) return null;

        // Ambil target triwulan yang sesuai
        $target = $ikp->targetIkps()
            ->where('id_satker', $this->id_satker)
            ->where('tahun', $this->tahun)
            ->first();

        if (!$target) return null;

        $kolom_tw = 'target_tw' . $this->triwulan;
        $nilai_target = $target->{$kolom_tw} ?? $target->target_tahun;

        if (!$nilai_target || $nilai_target == 0) return null;
        if ($this->realisasi === null) return null;

        // Untuk indikator UNFAVORABLE (semakin kecil semakin baik)
        // misal: IKK 2.1.1.1 Temuan BPK
        if ($ikp->sifat_node === 'UNFAVORABLE') {
            return round(($nilai_target / $this->realisasi) * 100, 2);
        }

        // Default: FAVORABLE (semakin besar semakin baik)
        return round(($this->realisasi / $nilai_target) * 100, 2);
    }
}
