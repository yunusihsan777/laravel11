<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndikatorKinerjaProgram;
use App\Models\TargetIkp;

class TargetIkpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = ['2025', '2026'];

        $targets = [
            // BPA (691270)
            '691270' => [
                'IKP 13.1' => 90.00,
                'IKP 13.2' => 90.00,
                'IKP 13.3' => 90.00,
                'IKP 14.1' => 4.00,
                'IKP 14.2' => 4.00,
                'IKP 14.3' => 4.00,
            ],
            // PIDSUS (419344)
            '419344' => [
                'IKP 5.1' => 77.00,
                'IKP 5.2' => 84.00,
                'IKP 5.3' => 84.00,
                'IKP 5.5' => 20.00,
                'IKP 5.6' => 85.00,
                'IKP 5.7' => 72.00,
                'IKP 6.1' => 27.00,
                'IKP 6.2' => 35.00,
                'IKP 15.1' => 85.00,
                'IKP 17.1' => 3.60,
                'IKP 18.1' => 80.00,
            ],
            // PIDUM (418326)
            '418326' => [
                'IKP 3.1' => 80.00,
                'IKP 3.2' => 80.00,
                'IKP 3.3' => 88.00,
                'IKP 4.1' => 61.00,
                'IKP 4.2' => 0.00,
                'IKP 15.1' => 85.00,
                'IKP 17.1' => 3.60,
                'IKP 18.1' => 80.00,
                'IKP_PIDUM_MGMT.1' => 460.00,
            ],
            // DATUN (417023)
            '417023' => [
                'IKP 1.1' => 100.00,
                'IKP 2.1' => 3.60,
                'IKP 7.1' => 80.00,
                'IKP 7.2' => 80.00,
                'IKP 8.1' => 80.00,
                'IKP 8.2' => 80.00,
                'IKP 8.3' => 80.00,
                'IKP 16.1' => 3.60,
                'IKP 17.1' => 3.60,
                'IKP 18.1' => 80.00,
            ],
            // PIDMIL (677111)
            '677111' => [
                'IKP 9.1' => 80.00,
                'IKP 9.2' => 80.00,
                'IKP 9.3' => 80.00,
                'IKP 9.4' => 80.00,
                'IKP 9.5' => 80.00,
                'IKP 10.1' => 80.00,
                'IKP 10.2' => 80.00,
                'IKP 10.3' => 80.00,
                'IKP 15.1' => 85.00,
                'IKP 16.1' => 3.60,
                'IKP_PIDMIL_MGMT.1' => 100.00,
            ],
            // BADIKLAT (666405)
            '666405' => [
                'IKP 9.1' => 3.60,
                'IKP 10.1' => 3.60,
            ],
            // JAMWAS (419346)
            '419346' => [
                'IKP 2.1' => 100.00,
                'IKP 3.1' => 3.20,
                'IKP 12.1' => 75.00,
                'IKP 14.1' => 80.00,
                'IKP_WAS_OPS.1' => 70.00,
                'IKP_WAS_MGMT.1' => 100.00,
            ],
            // JAMINTEL (419345)
            '419345' => [
                'IKP 11.1' => 80.00,
                'IKP 11.2' => 80.00,
                'IKP 11.3' => 80.00,
                'IKP 11.4' => 80.00,
                'IKP 11.5' => 80.00,
                'IKP 11.6' => 80.00,
                'IKP 11.7' => 80.00,
                'IKP 11.8' => 4.00,
            ],
        ];

        foreach ($years as $year) {
            foreach ($targets as $satkerId => $ikpTargets) {
                foreach ($ikpTargets as $kodeIkp => $val) {
                    $ikp = IndikatorKinerjaProgram::where('kode_ikp', $kodeIkp)
                        ->where('id_satker', $satkerId)
                        ->where('tahun', $year)
                        ->first();

                    if (!$ikp) {
                        continue;
                    }

                    TargetIkp::updateOrCreate(
                        [
                            'ikp_id' => $ikp->id,
                            'id_satker' => $satkerId,
                            'tahun' => $year,
                        ],
                        [
                            'sp_id' => $ikp->sasaran_program_id,
                            'target_tahun' => $val,
                            'target_tw1' => $val,
                            'target_tw2' => $val,
                            'target_tw3' => $val,
                            'target_tw4' => $val,
                        ]
                    );
                }
            }
        }
    }
}
