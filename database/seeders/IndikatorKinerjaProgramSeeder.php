<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SasaranProgram;
use App\Models\IndikatorKinerjaProgram;

class IndikatorKinerjaProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = ['2025', '2026'];

        $ikpData = [
            // BPA (691270)
            [
                'id_satker' => '691270',
                'kode_sp' => 'SP 13',
                'ikps' => [
                    ['kode_ikp' => 'IKP 13.1', 'nama_ikp' => 'Tingkat keberhasilan kegiatan penelusuran aset', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 13.2', 'nama_ikp' => 'Tingkat keberhasilan perampasan aset hasil tindak pidana', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 13.3', 'nama_ikp' => 'Tingkat keberhasilan pemulihan aset hasil tindak pidana', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '691270',
                'kode_sp' => 'SP 14',
                'ikps' => [
                    ['kode_ikp' => 'IKP 14.1', 'nama_ikp' => 'Tingkat efektivitas pengelolaan Rupbasan', 'sifat_node' => 'AVERAGE'],
                    ['kode_ikp' => 'IKP 14.2', 'nama_ikp' => 'Tingkat efektivitas penyelesaian penyelamatan aset negara', 'sifat_node' => 'AVERAGE'],
                    ['kode_ikp' => 'IKP 14.3', 'nama_ikp' => 'Tingkat efektivitas pengelolaan data aset negara berbasis teknologi informasi', 'sifat_node' => 'AVERAGE'],
                ],
            ],

            // PIDSUS (419344)
            [
                'id_satker' => '419344',
                'kode_sp' => 'SP 5',
                'ikps' => [
                    ['kode_ikp' => 'IKP 5.1', 'nama_ikp' => 'Tingkat keberhasilan penanganan perkara tindak pidana korupsi dan TPPU', 'sifat_node' => 'AVERAGE'],
                    ['kode_ikp' => 'IKP 5.2', 'nama_ikp' => 'Tingkat keberhasilan penanganan perkara tindak pidana perpajakan dan TPPU', 'sifat_node' => 'AVERAGE'],
                    ['kode_ikp' => 'IKP 5.3', 'nama_ikp' => 'Tingkat keberhasilan penanganan perkara tindak pidana kepabeanan, cukai dan TPPU', 'sifat_node' => 'AVERAGE'],
                    ['kode_ikp' => 'IKP 5.5', 'nama_ikp' => 'Tingkat keberhasilan penanganan perkara tindak pidana khusus lainnya yang merugikan perekonomian negara dan TPPU', 'sifat_node' => 'AVERAGE'],
                    ['kode_ikp' => 'IKP 5.6', 'nama_ikp' => 'Tingkat keberhasilan penanganan perkara pelanggaran HAM yang berat', 'sifat_node' => 'AVERAGE'],
                    ['kode_ikp' => 'IKP 5.7', 'nama_ikp' => 'Tingkat keberhasilan pengendalian pelaksanaan operasi intelijen yustisial dan penindakan', 'sifat_node' => 'AVERAGE'],
                ],
            ],
            [
                'id_satker' => '419344',
                'kode_sp' => 'SP 6',
                'ikps' => [
                    ['kode_ikp' => 'IKP 6.1', 'nama_ikp' => 'Persentase penyelamatan kerugian keuangan negara dari penanganan perkara tindak pidana korupsi', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 6.2', 'nama_ikp' => 'Persentase penyelesaian pembayaran pidana denda perkara tindak pidana khusus lainnya', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '419344',
                'kode_sp' => 'SP 15',
                'ikps' => [
                    ['kode_ikp' => 'IKP 15.1', 'nama_ikp' => 'Persentase pemanfaatan Case Management System (CMS) bidang Pidsus', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '419344',
                'kode_sp' => 'SP 17',
                'ikps' => [
                    ['kode_ikp' => 'IKP 17.1', 'nama_ikp' => 'Indeks kepuasan masyarakat terhadap layanan publik bidang Pidsus', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],
            [
                'id_satker' => '419344',
                'kode_sp' => 'SP 18',
                'ikps' => [
                    ['kode_ikp' => 'IKP 18.1', 'nama_ikp' => 'Persentase pemenuhan dan pemanfaatan sarana prasarana bidang Pidsus', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],

            // PIDUM (418326)
            [
                'id_satker' => '418326',
                'kode_sp' => 'SP 3',
                'ikps' => [
                    ['kode_ikp' => 'IKP 3.1', 'nama_ikp' => 'Tingkat penyelesaian penanganan perkara tindak pidana umum pada tahap prapenuntutan', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 3.2', 'nama_ikp' => 'Tingkat penyelesaian penanganan perkara tindak pidana umum pada tahap penuntutan', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 3.3', 'nama_ikp' => 'Tingkat penyelesaian pelaksanaan putusan pengadilan yang telah berkekuatan hukum tetap (eksekusi)', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '418326',
                'kode_sp' => 'SP 4',
                'ikps' => [
                    ['kode_ikp' => 'IKP 4.1', 'nama_ikp' => 'Persentase penyelesaian perkara tindak pidana umum melalui mekanisme Keadilan Restoratif (Restorative Justice)', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 4.2', 'nama_ikp' => 'Persentase pelaksanaan pidana kerja sosial dan pidana pengawasan sebagai alternatif pemidanaan penjara (KUHP Baru)', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '418326',
                'kode_sp' => 'SP 15',
                'ikps' => [
                    ['kode_ikp' => 'IKP 15.1', 'nama_ikp' => 'Persentase pemanfaatan Case Management System (CMS) bidang Pidum', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '418326',
                'kode_sp' => 'SP 17',
                'ikps' => [
                    ['kode_ikp' => 'IKP 17.1', 'nama_ikp' => 'Indeks kepuasan masyarakat terhadap layanan publik bidang Pidum', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],
            [
                'id_satker' => '418326',
                'kode_sp' => 'SP 18',
                'ikps' => [
                    ['kode_ikp' => 'IKP 18.1', 'nama_ikp' => 'Persentase pemenuhan dan pemanfaatan sarana prasarana bidang Pidum', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '418326',
                'kode_sp' => 'SP_PIDUM_MGMT',
                'ikps' => [
                    ['kode_ikp' => 'IKP_PIDUM_MGMT.1', 'nama_ikp' => 'Jumlah Jaksa yang telah tersertifikasi/mengikuti diklat teknis tindak pidana umum', 'sifat_node' => 'DIRECT_INPUT'],
                ],
            ],

            // DATUN (417023)
            [
                'id_satker' => '417023',
                'kode_sp' => 'SP 1',
                'ikps' => [
                    ['kode_ikp' => 'IKP 1.1', 'nama_ikp' => 'Persentase pemberian pertimbangan hukum (legal audit/legal opinion/legal assistance) yang ditindaklanjuti', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '417023',
                'kode_sp' => 'SP 2',
                'ikps' => [
                    ['kode_ikp' => 'IKP 2.1', 'nama_ikp' => 'Indeks persepsi kualitas pelayanan hukum Datun', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],
            [
                'id_satker' => '417023',
                'kode_sp' => 'SP 7',
                'ikps' => [
                    ['kode_ikp' => 'IKP 7.1', 'nama_ikp' => 'Persentase penyelamatan keuangan/kekayaan negara bidang perdata dan tata usaha negara', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 7.2', 'nama_ikp' => 'Persentase pemulihan keuangan/kekayaan negara bidang perdata dan tata usaha negara', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '417023',
                'kode_sp' => 'SP 8',
                'ikps' => [
                    ['kode_ikp' => 'IKP 8.1', 'nama_ikp' => 'Persentase keberhasilan penanganan perkara perdata secara litigasi', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 8.2', 'nama_ikp' => 'Persentase keberhasilan penyelesaian masalah perdata secara non-litigasi/negosiasi/mediasi', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 8.3', 'nama_ikp' => 'Persentase keberhasilan penanganan perkara tata usaha negara (TUN)', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '417023',
                'kode_sp' => 'SP 16',
                'ikps' => [
                    ['kode_ikp' => 'IKP 16.1', 'nama_ikp' => 'Indeks kepuasan pelayanan hukum gratis bidang Datun', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],
            [
                'id_satker' => '417023',
                'kode_sp' => 'SP 17',
                'ikps' => [
                    ['kode_ikp' => 'IKP 17.1', 'nama_ikp' => 'Indeks kepuasan masyarakat terhadap layanan publik bidang Datun', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],
            [
                'id_satker' => '417023',
                'kode_sp' => 'SP 18',
                'ikps' => [
                    ['kode_ikp' => 'IKP 18.1', 'nama_ikp' => 'Persentase pemenuhan dan pemanfaatan sarana prasarana bidang Datun', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],

            // PIDMIL (677111)
            [
                'id_satker' => '677111',
                'kode_sp' => 'SP 9',
                'ikps' => [
                    ['kode_ikp' => 'IKP 9.1', 'nama_ikp' => 'Persentase penyelesaian penanganan perkara koneksitas pada tahap penyelidikan', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 9.2', 'nama_ikp' => 'Persentase penyelesaian penanganan perkara koneksitas pada tahap penyidikan', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 9.3', 'nama_ikp' => 'Persentase penyelesaian penanganan perkara koneksitas pada tahap penuntutan', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 9.4', 'nama_ikp' => 'Persentase penyelesaian pelaksanaan putusan pengadilan berkekuatan hukum tetap (eksekusi) perkara koneksitas', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 9.5', 'nama_ikp' => 'Persentase pengembalian dan pemulihan kerugian keuangan negara akibat tindak pidana koneksitas', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '677111',
                'kode_sp' => 'SP 10',
                'ikps' => [
                    ['kode_ikp' => 'IKP 10.1', 'nama_ikp' => 'Persentase koordinasi teknis penuntutan pada tahap penindakan perkara koneksitas', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 10.2', 'nama_ikp' => 'Persentase koordinasi teknis penuntutan pada tahap penuntutan perkara koneksitas', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 10.3', 'nama_ikp' => 'Persentase koordinasi teknis penuntutan pada tahap eksekusi dan upaya hukum luar biasa', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '677111',
                'kode_sp' => 'SP 15',
                'ikps' => [
                    ['kode_ikp' => 'IKP 15.1', 'nama_ikp' => 'Persentase pemanfaatan Case Management System (CMS) bidang Pidmil', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '677111',
                'kode_sp' => 'SP 16',
                'ikps' => [
                    ['kode_ikp' => 'IKP 16.1', 'nama_ikp' => 'Indeks kepuasan relasi kelembagaan TNI dan stakeholder peradilan militer', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],
            [
                'id_satker' => '677111',
                'kode_sp' => 'SP_PIDMIL_MGMT',
                'ikps' => [
                    ['kode_ikp' => 'IKP_PIDMIL_MGMT.1', 'nama_ikp' => 'Persentase ketepatan waktu penyusunan laporan perkara koneksitas', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],

            // BADIKLAT (666405)
            [
                'id_satker' => '666405',
                'kode_sp' => 'SP 9',
                'ikps' => [
                    ['kode_ikp' => 'IKP 9.1', 'nama_ikp' => 'Indeks kepuasan pengguna layanan kediklatan Kejaksaan RI', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],
            [
                'id_satker' => '666405',
                'kode_sp' => 'SP 10',
                'ikps' => [
                    ['kode_ikp' => 'IKP 10.1', 'nama_ikp' => 'Indeks kepuasan layanan kesekretariatan dan dukungan operasional Badiklat', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],

            // JAMWAS (419346)
            [
                'id_satker' => '419346',
                'kode_sp' => 'SP 2',
                'ikps' => [
                    ['kode_ikp' => 'IKP 2.1', 'nama_ikp' => 'Opini BPK atas Laporan Keuangan Kejaksaan RI (WTP)', 'sifat_node' => 'DIRECT_INPUT'],
                ],
            ],
            [
                'id_satker' => '419346',
                'kode_sp' => 'SP 3',
                'ikps' => [
                    ['kode_ikp' => 'IKP 3.1', 'nama_ikp' => 'Nilai Maturitas Penyelenggaraan SPIP Terintegrasi', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],
            [
                'id_satker' => '419346',
                'kode_sp' => 'SP 12',
                'ikps' => [
                    ['kode_ikp' => 'IKP 12.1', 'nama_ikp' => 'Nilai Indeks Survei Penilaian Integritas (SPI) KPK di lingkungan Kejaksaan RI', 'sifat_node' => 'INDEX_SCORE'],
                ],
            ],
            [
                'id_satker' => '419346',
                'kode_sp' => 'SP 14',
                'ikps' => [
                    ['kode_ikp' => 'IKP 14.1', 'nama_ikp' => 'Persentase satuan kerja yang memenuhi kriteria Zona Integritas (WBK/WBBM)', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '419346',
                'kode_sp' => 'SP_WAS_OPS',
                'ikps' => [
                    ['kode_ikp' => 'IKP_WAS_OPS.1', 'nama_ikp' => 'Persentase penyelesaian tindak lanjut hasil pengawasan (TLHP) internal dan eksternal', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            [
                'id_satker' => '419346',
                'kode_sp' => 'SP_WAS_MGMT',
                'ikps' => [
                    ['kode_ikp' => 'IKP_WAS_MGMT.1', 'nama_ikp' => 'Persentase pemenuhan standar layanan pengawasan internal sesuai SLA', 'sifat_node' => 'RATIO_PERCENTAGE'],
                ],
            ],
            // JAMINTEL (419345)
            [
                'id_satker' => '419345',
                'kode_sp' => 'SP 11',
                'ikps' => [
                    ['kode_ikp' => 'IKP 11.1', 'nama_ikp' => 'Persentase Hasil Kegiatan Pelaksanaan Operasi Intelijen di Bidang Ideologi, Politik, Pertahanan, dan Keamanan', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 11.2', 'nama_ikp' => 'Persentase Hasil Kegiatan Pelaksanaan Operasi Intelijen di Bidang Sosial Budaya dan Kemasyarakatan', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 11.3', 'nama_ikp' => 'Persentase Hasil Kegiatan Pelaksanaan Operasi Intelijen di Bidang Ekonomi dan Keuangan', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 11.4', 'nama_ikp' => 'Persentase Pembangunan Strategis Yang Diberikan Pengawalan', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 11.5', 'nama_ikp' => 'Persentase Hasil Kegiatan Pelaksanaan Operasi Intelijen di Bidang Teknologi Informasi dan Produksi Intelijen', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 11.6', 'nama_ikp' => 'Persentase Pelaksanaan Major Project Penguatan NSOC SOC dan Pembentukan 121 CSIRT', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 11.7', 'nama_ikp' => 'Persentase Lembaga atau Pihak Yang Diberi Penyuluhan Dan Penerangan Hukum', 'sifat_node' => 'RATIO_PERCENTAGE'],
                    ['kode_ikp' => 'IKP 11.8', 'nama_ikp' => 'Indeks Kepuasan Pemangku Kepentingan Terhadap Layanan Penyuluhan dan Penerangan Hukum', 'sifat_node' => 'AVERAGE'],
                ],
            ],
        ];

        foreach ($years as $year) {
            foreach ($ikpData as $group) {
                $sp = SasaranProgram::where('kode_sp', $group['kode_sp'])
                    ->where('id_satker', $group['id_satker'])
                    ->where('tahun', $year)
                    ->first();

                if (!$sp) {
                    continue;
                }

                foreach ($group['ikps'] as $ikp) {
                    IndikatorKinerjaProgram::updateOrCreate(
                        [
                            'kode_ikp' => $ikp['kode_ikp'],
                            'id_satker' => $group['id_satker'],
                            'tahun' => $year,
                        ],
                        [
                            'sasaran_program_id' => $sp->id,
                            'nama_ikp' => $ikp['nama_ikp'],
                            'sifat_node' => $ikp['sifat_node'],
                        ]
                    );
                }
            }
        }
    }
}
