<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateBuktiDukung extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lke:migrate-bukti {--fresh : Truncate lke_satker_bukti before migrating}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from legacy bukti_dukung table to lke_satker_bukti table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting migration of bukti_dukung to lke_satker_bukti...');

        if ($this->option('fresh')) {
            DB::table('lke_satker_bukti')->truncate();
            $this->warn('lke_satker_bukti truncated.');
        }

        $total = DB::table('bukti_dukung')->count();
        $this->info("Total rows in bukti_dukung: {$total}");

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $chunkSize = 1000;

        DB::table('bukti_dukung')->orderBy('id')->chunk($chunkSize, function ($rows) use ($bar) {
            $insertData = [];
            $now = now();

            foreach ($rows as $r) {
                $tahun = null;
                if (!empty($r->link_bukti_dukung) && preg_match('/(202[0-9])/', $r->link_bukti_dukung, $m)) {
                    $tahun = (int)$m[1];
                } elseif (!empty($r->tgl_pengisian) && preg_match('/(202[0-9])/', $r->tgl_pengisian, $m)) {
                    $tahun = (int)$m[1];
                } else {
                    $tahun = 2025;
                }

                $buktidukung_id = is_numeric($r->kode_bukti) ? (int)$r->kode_bukti : null;

                $insertData[] = [
                    'id_satker'          => $r->id_satker,
                    'komponen_id'        => $r->id_komponen,
                    'sub_komponen_id'    => $r->id_sub_komponen,
                    'kriteria_id'        => $r->id_kriteria,
                    'kode_bukti'         => $r->kode_bukti,
                    'buktidukung_id'     => $buktidukung_id,
                    'link_bukti_dukung'  => $r->link_bukti_dukung,
                    'tgl_pengisian'      => $r->tgl_pengisian,
                    'tahun'              => $tahun,
                    'created_at'         => $now,
                    'updated_at'         => $now,
                ];
            }

            if (!empty($insertData)) {
                DB::table('lke_satker_bukti')->insert($insertData);
            }

            $bar->advance(count($rows));
        });

        $bar->finish();
        $this->newLine();
        $this->info('Migration completed successfully! Migrated count: ' . DB::table('lke_satker_bukti')->count());
    }
}
