<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Permohonan;
use App\Models\PenerbitanBerkas;

class MigratePenerbitanBerkas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'penerbitan:migrate-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pindahkan data Permohonan lama (role penerbitan_berkas) ke tabel penerbitan_berkas';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Memulai migrasi data...');

        $query = Permohonan::with('user')->whereHas('user', function ($q) {
            $q->where('role', 'penerbitan_berkas');
        });

        $total = $query->count();
        $this->info("Total kandidat data: {$total}");

        $migrated = 0;

        $query->chunkById(200, function ($rows) use (&$migrated) {
            foreach ($rows as $row) {
                // Skip if already migrated (based on unique no_permohonan)
                if ($row->no_permohonan && PenerbitanBerkas::where('no_permohonan', $row->no_permohonan)->exists()) {
                    continue;
                }

                PenerbitanBerkas::create([
                    'user_id' => $row->user_id,
                    'no_permohonan' => $row->no_permohonan,
                    'no_proyek' => $row->no_proyek,
                    'tanggal_permohonan' => $row->tanggal_permohonan,
                    'nib' => $row->nib,
                    'kbli' => $row->kbli,
                    'nama_usaha' => $row->nama_usaha,
                    'inputan_teks' => $row->inputan_teks,
                    'jenis_pelaku_usaha' => $row->jenis_pelaku_usaha,
                    'jenis_badan_usaha' => $row->jenis_badan_usaha,
                    'pemilik' => $row->pemilik,
                    'modal_usaha' => $row->modal_usaha,
                    'alamat_perusahaan' => $row->alamat_perusahaan,
                    'jenis_proyek' => $row->jenis_proyek,
                    'nama_perizinan' => $row->nama_perizinan,
                    'skala_usaha' => $row->skala_usaha,
                    'risiko' => $row->risiko,
                    'status' => $row->status ?? 'Menunggu',
                ]);

                $migrated++;
            }
        });

        $this->info("Migrasi selesai. Data dipindah: {$migrated}");
        return self::SUCCESS;
    }
}


