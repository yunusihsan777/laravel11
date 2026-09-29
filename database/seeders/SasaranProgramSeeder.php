<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SasaranProgram;

class SasaranProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = ['2025', '2026'];

        $sps = [
            // BPA (691270)
            [
                'kode_sp' => 'SP 13',
                'nama_sp' => 'Terselenggaranya pemulihan aset yang terintegrasi',
                'id_satker' => '691270',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 14',
                'nama_sp' => 'Terwujudnya pengelolaan aset tindak pidana yang transparan, akuntabel, dan modern',
                'id_satker' => '691270',
                'is_crosscutting' => 0,
            ],

            // PIDSUS (419344)
            [
                'kode_sp' => 'SP 5',
                'nama_sp' => 'Meningkatnya keberhasilan penanganan perkara tindak pidana khusus secara transparan, akuntabel dan profesional',
                'id_satker' => '419344',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 6',
                'nama_sp' => 'Meningkatnya penyelamatan dan pengembalian kerugian keuangan negara dari penanganan perkara tindak pidana khusus',
                'id_satker' => '419344',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 15',
                'nama_sp' => 'Meningkatnya kualitas sistem penuntutan yang terintegrasi dan transparan (CMS)',
                'id_satker' => '419344',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP 17',
                'nama_sp' => 'Meningkatnya Kualitas Layanan Publik bidang penegakan hukum',
                'id_satker' => '419344',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP 18',
                'nama_sp' => 'Meningkatnya efektivitas pemanfaatan sarana dan prasarana',
                'id_satker' => '419344',
                'is_crosscutting' => 1,
            ],

            // PIDUM (418326)
            [
                'kode_sp' => 'SP 3',
                'nama_sp' => 'Meningkatnya penanganan perkara tindak pidana umum yang berorientasi pada kepastian hukum, keadilan, dan kemanfaatan',
                'id_satker' => '418326',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 4',
                'nama_sp' => 'Meningkatnya penegakan hukum yang adil, humanis, proporsional, dan efisien melalui pendekatan keadilan restoratif',
                'id_satker' => '418326',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP 15',
                'nama_sp' => 'Meningkatnya kualitas sistem penuntutan yang terintegrasi dan transparan (CMS)',
                'id_satker' => '418326',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP 17',
                'nama_sp' => 'Meningkatnya Kualitas Layanan Publik bidang penegakan hukum',
                'id_satker' => '418326',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP 18',
                'nama_sp' => 'Meningkatnya efektivitas pemanfaatan sarana dan prasarana',
                'id_satker' => '418326',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP_PIDUM_MGMT',
                'nama_sp' => 'Meningkatnya kapasitas dan kapabilitas SDM penanganan perkara tindak pidana umum',
                'id_satker' => '418326',
                'is_crosscutting' => 0,
            ],

            // DATUN (417023)
            [
                'kode_sp' => 'SP 1',
                'nama_sp' => 'Meningkatnya kualitas peran Advocaat Generaal dan Jaksa Pengacara Negara (JPN) dalam penegakan hukum',
                'id_satker' => '417023',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 2',
                'nama_sp' => 'Meningkatnya efektivitas pelayanan hukum oleh Jaksa Pengacara Negara',
                'id_satker' => '417023',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 7',
                'nama_sp' => 'Meningkatnya penyelamatan dan pemulihan keuangan/kekayaan negara melalui jalur perdata',
                'id_satker' => '417023',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 8',
                'nama_sp' => 'Meningkatnya keberhasilan penanganan perkara Perdata dan Tata Usaha Negara',
                'id_satker' => '417023',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 16',
                'nama_sp' => 'Meningkatnya Kualitas Layanan Publik bidang hukum',
                'id_satker' => '417023',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP 17',
                'nama_sp' => 'Meningkatnya Kualitas Layanan Publik bidang penegakan hukum',
                'id_satker' => '417023',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP 18',
                'nama_sp' => 'Meningkatnya efektivitas pemanfaatan sarana dan prasarana',
                'id_satker' => '417023',
                'is_crosscutting' => 1,
            ],

            // PIDMIL (677111)
            [
                'kode_sp' => 'SP 9',
                'nama_sp' => 'Meningkatnya efektivitas penanganan perkara koneksitas yang adil dan akuntabel',
                'id_satker' => '677111',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 10',
                'nama_sp' => 'Meningkatnya koordinasi teknis penuntutan yang dilakukan oleh Oditurat',
                'id_satker' => '677111',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 15',
                'nama_sp' => 'Meningkatnya kualitas sistem penuntutan yang terintegrasi dan transparan (CMS)',
                'id_satker' => '677111',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP 16',
                'nama_sp' => 'Meningkatnya Kualitas Layanan Publik bidang hukum',
                'id_satker' => '677111',
                'is_crosscutting' => 1,
            ],
            [
                'kode_sp' => 'SP_PIDMIL_MGMT',
                'nama_sp' => 'Meningkatnya dukungan teknis operasional penanganan perkara koneksitas',
                'id_satker' => '677111',
                'is_crosscutting' => 0,
            ],

            // BADIKLAT (666405)
            [
                'kode_sp' => 'SP 9',
                'nama_sp' => 'Meningkatnya Kualitas dan Kompetensi SDM Kejaksaan melalui Penyelenggaraan Pendidikan dan Pelatihan',
                'id_satker' => '666405',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 10',
                'nama_sp' => 'Meningkatnya kualitas layanan internal dukungan manajemen Badan Pendidikan dan Pelatihan',
                'id_satker' => '666405',
                'is_crosscutting' => 0,
            ],

            // JAMWAS (419346)
            [
                'kode_sp' => 'SP 2',
                'nama_sp' => 'Meningkatnya akuntabilitas pengelolaan keuangan dan kepatuhan perbendaharaan Kejaksaan RI',
                'id_satker' => '419346',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 3',
                'nama_sp' => 'Meningkatnya efektivitas sistem pengendalian intern pemerintah (SPIP) di lingkungan Kejaksaan RI',
                'id_satker' => '419346',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 12',
                'nama_sp' => 'Meningkatnya integritas aparatur Kejaksaan Republik Indonesia',
                'id_satker' => '419346',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP 14',
                'nama_sp' => 'Terwujudnya birokrasi Kejaksaan yang bersih dan melayani (Pembangunan ZI)',
                'id_satker' => '419346',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP_WAS_OPS',
                'nama_sp' => 'Meningkatnya kualitas dan ketepatan waktu pelaksanaan pengawasan internal',
                'id_satker' => '419346',
                'is_crosscutting' => 0,
            ],
            [
                'kode_sp' => 'SP_WAS_MGMT',
                'nama_sp' => 'Meningkatnya dukungan manajemen dan tata kelola bidang pengawasan',
                'id_satker' => '419346',
                'is_crosscutting' => 0,
            ],

            // JAMINTEL (419345)
            [
                'kode_sp' => 'SP 11',
                'nama_sp' => 'Meningkatnya efektivitas fungsi intelijen penegakan hukum',
                'id_satker' => '419345',
                'is_crosscutting' => 0,
            ],
        ];

        foreach ($years as $year) {
            foreach ($sps as $sp) {
                SasaranProgram::updateOrCreate(
                    [
                        'kode_sp' => $sp['kode_sp'],
                        'id_satker' => $sp['id_satker'],
                        'tahun' => $year,
                    ],
                    [
                        'nama_sp' => $sp['nama_sp'],
                        'is_crosscutting' => $sp['is_crosscutting'],
                    ]
                );
            }
        }
    }
}
