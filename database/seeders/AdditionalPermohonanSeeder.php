<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permohonan;
use App\Models\User;
use Carbon\Carbon;

class AdditionalPermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user untuk testing
        $users = User::all();
        if ($users->isEmpty()) {
            $this->command->error('No users found. Please run UserSeeder first.');
            return;
        }

        $this->command->info('Adding 15 more permohonan data...');

        // Daftar sektor yang tersedia
        $sektors = ['Dinkopdag', 'Disbudpar', 'Dinkes', 'Dishub', 'Dprkpp', 'Dkpp', 'Dlh', 'Disperinaker'];

        // Data tambahan dengan logika yang benar
        $data = [
            // 5 Data Diterima (SELESAI)
            [
                'no_permohonan' => 'I-202504291626428624608',
                'nama_usaha' => 'PT. MAJU TERUS PANTANG MUNDUR',
                'sektor' => 'Dinkopdag',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-10',
                'deadline' => '2025-02-10',
                'verifikator' => 'Ahmad Wijaya, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],
            [
                'no_permohonan' => 'I-202504291626428624609',
                'nama_usaha' => 'CV. SUKSES ABADI',
                'sektor' => 'Disbudpar',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-11',
                'deadline' => '2025-02-11',
                'verifikator' => 'Budi Santoso, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],
            [
                'no_permohonan' => 'I-202504291626428624610',
                'nama_usaha' => 'UD. BERKAH SELALU',
                'sektor' => 'Dinkes',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-12',
                'deadline' => '2025-02-12',
                'verifikator' => 'Citra Dewi, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],
            [
                'no_permohonan' => 'I-202504291626428624611',
                'nama_usaha' => 'PT. JAYA MAKMUR',
                'sektor' => 'Dishub',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-13',
                'deadline' => '2025-02-13',
                'verifikator' => 'Dedi Kurniawan, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],
            [
                'no_permohonan' => 'I-202504291626428624612',
                'nama_usaha' => 'CV. LANCAR JAYA',
                'sektor' => 'Dprkpp',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-14',
                'deadline' => '2025-02-14',
                'verifikator' => 'Eka Putri, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],

            // 3 Data Ditolak (SELESAI)
            [
                'no_permohonan' => 'I-202504291626428624613',
                'nama_usaha' => 'PT. TIDAK LAYAK LAGI',
                'sektor' => 'Dkpp',
                'status' => 'Ditolak',
                'tanggal_permohonan' => '2025-01-15',
                'deadline' => '2025-02-15',
                'verifikator' => 'Fajar Nugroho, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Ditolak',
            ],
            [
                'no_permohonan' => 'I-202504291626428624614',
                'nama_usaha' => 'UD. GAGAL TOTAL',
                'sektor' => 'Dlh',
                'status' => 'Ditolak',
                'tanggal_permohonan' => '2025-01-16',
                'deadline' => '2025-02-16',
                'verifikator' => 'Gita Sari, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Ditolak',
            ],
            [
                'no_permohonan' => 'I-202504291626428624615',
                'nama_usaha' => 'CV. TIDAK MEMENUHI SYARAT',
                'sektor' => 'Disperinaker',
                'status' => 'Ditolak',
                'tanggal_permohonan' => '2025-01-17',
                'deadline' => '2025-02-17',
                'verifikator' => 'Hendra Pratama, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Ditolak',
            ],

            // 7 Data Dikembalikan (MASIH PROSES)
            // 3 Data Dikembalikan TERLAMBAT
            [
                'no_permohonan' => 'I-202504291626428624616',
                'nama_usaha' => 'PT. PERLU REVISI BESAR',
                'sektor' => 'Dinkopdag',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-05',
                'deadline' => '2025-01-18', // TERLAMBAT (deadline sudah lewat)
                'verifikator' => 'Indah Lestari, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624617',
                'nama_usaha' => 'CV. BELUM LENGKAP SEMUA',
                'sektor' => 'Disbudpar',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-06',
                'deadline' => '2025-01-19', // TERLAMBAT (deadline sudah lewat)
                'verifikator' => 'Joko Susilo, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624618',
                'nama_usaha' => 'UD. SEDANG DIPERBAIKI LAGI',
                'sektor' => 'Dinkes',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-07',
                'deadline' => '2025-01-20', // TERLAMBAT (deadline sudah lewat)
                'verifikator' => 'Ahmad Wijaya, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],

            // 4 Data Dikembalikan NORMAL (tidak terlambat)
            [
                'no_permohonan' => 'I-202504291626428624619',
                'nama_usaha' => 'PT. MENUNGGU KELENGKAPAN DOKUMEN',
                'sektor' => 'Dishub',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-25',
                'deadline' => '2025-02-25', // TIDAK TERLAMBAT
                'verifikator' => 'Budi Santoso, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624620',
                'nama_usaha' => 'CV. PROSES PERBAIKAN BERKAS',
                'sektor' => 'Dprkpp',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-26',
                'deadline' => '2025-02-26', // TIDAK TERLAMBAT
                'verifikator' => 'Citra Dewi, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624621',
                'nama_usaha' => 'UD. REVISI DOKUMEN LENGKAP',
                'sektor' => 'Dkpp',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-27',
                'deadline' => '2025-02-27', // TIDAK TERLAMBAT
                'verifikator' => 'Dedi Kurniawan, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624622',
                'nama_usaha' => 'PT. TAMBAHAN DATA LENGKAP',
                'sektor' => 'Dlh',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-28',
                'deadline' => '2025-02-28', // TIDAK TERLAMBAT
                'verifikator' => 'Eka Putri, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
        ];

        // Buat data permohonan
        foreach ($data as $index => $item) {
            $user = $users->random();
            
            Permohonan::create([
                'no_permohonan' => $item['no_permohonan'],
                'no_proyek' => 'PROJ-' . str_pad($index + 16, 3, '0', STR_PAD_LEFT),
                'tanggal_permohonan' => $item['tanggal_permohonan'],
                'nib' => 'NIB' . str_pad($index + 16, 6, '0', STR_PAD_LEFT),
                'alamat_perusahaan' => 'Alamat ' . ($index + 16),
                'sektor' => $item['sektor'],
                'kbli' => 'KBLI-' . str_pad($index + 16, 3, '0', STR_PAD_LEFT),
                'inputan_teks' => 'Inputan ' . ($index + 16),
                'modal_usaha' => 'Modal ' . ($index + 16),
                'jenis_proyek' => 'Jenis Proyek ' . ($index + 16),
                'nama_perizinan' => 'Perizinan ' . ($index + 16),
                'skala_usaha' => 'Skala ' . ($index + 16),
                'risiko' => 'Risiko ' . ($index + 16),
                'jangka_waktu' => 30,
                'no_telephone' => '08123456789' . ($index + 15),
                'deadline' => $item['deadline'],
                'verifikator' => $item['verifikator'],
                'verifikasi_dpmptsp' => $item['verifikasi_dpmptsp'],
                'verifikasi_pd_teknis' => $item['verifikasi_pd_teknis'],
                'status' => $item['status'],
                'user_id' => $user->id,
                'created_at' => Carbon::parse($item['tanggal_permohonan']),
                'updated_at' => Carbon::parse($item['tanggal_permohonan']),
            ]);
        }

        $this->command->info('Created 15 additional permohonan records:');
        $this->command->info('- 5 Diterima (Selesai)');
        $this->command->info('- 3 Ditolak (Selesai)');
        $this->command->info('- 7 Dikembalikan (4 Normal + 3 Terlambat)');
        $this->command->info('- Total now: 30 data (20 status final + 10 Dikembalikan)');
        $this->command->info('- Terlambat: 5 data (hanya dari Dikembalikan yang deadline lewat)');
    }
}
