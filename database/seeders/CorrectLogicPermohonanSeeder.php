<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permohonan;
use App\Models\User;
use Carbon\Carbon;

class CorrectLogicPermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus semua data permohonan yang ada
        Permohonan::query()->delete();
        
        // Ambil user untuk testing
        $users = User::all();
        if ($users->isEmpty()) {
            $this->command->error('No users found. Please run UserSeeder first.');
            return;
        }

        $this->command->info('Creating correct logic permohonan data...');

        // Daftar sektor yang tersedia
        $sektors = ['Dinkopdag', 'Disbudpar', 'Dinkes', 'Dishub', 'Dprkpp', 'Dkpp', 'Dlh', 'Disperinaker'];

        // Data dengan logika yang benar
        $data = [
            // 5 Data Diterima (SELESAI)
            [
                'no_permohonan' => 'I-202504291626428624593',
                'nama_usaha' => 'PT. SAPTASUMBER LANCAR',
                'sektor' => 'Dinkopdag',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-01',
                'deadline' => '2025-01-31',
                'verifikator' => 'Ahmad Wijaya, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],
            [
                'no_permohonan' => 'I-202504291626428624594',
                'nama_usaha' => 'UD. BINTANG MULIA',
                'sektor' => 'Dkpp',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-02',
                'deadline' => '2025-02-01',
                'verifikator' => 'Budi Santoso, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],
            [
                'no_permohonan' => 'I-202504291626428624595',
                'nama_usaha' => 'CV. MAJU JAYA',
                'sektor' => 'Disbudpar',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-03',
                'deadline' => '2025-02-02',
                'verifikator' => 'Citra Dewi, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],
            [
                'no_permohonan' => 'I-202504291626428624596',
                'nama_usaha' => 'PT. SEJAHTERA ABADI',
                'sektor' => 'Dinkes',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-04',
                'deadline' => '2025-02-03',
                'verifikator' => 'Dedi Kurniawan, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],
            [
                'no_permohonan' => 'I-202504291626428624597',
                'nama_usaha' => 'UD. BERKAH MULIA',
                'sektor' => 'Dishub',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-05',
                'deadline' => '2025-02-04',
                'verifikator' => 'Eka Putri, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],

            // 3 Data Ditolak (SELESAI)
            [
                'no_permohonan' => 'I-202504291626428624598',
                'nama_usaha' => 'PT. GAGAL LANCAR',
                'sektor' => 'Dprkpp',
                'status' => 'Ditolak',
                'tanggal_permohonan' => '2025-01-06',
                'deadline' => '2025-02-05',
                'verifikator' => 'Fajar Nugroho, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Ditolak',
            ],
            [
                'no_permohonan' => 'I-202504291626428624599',
                'nama_usaha' => 'CV. TIDAK LAYAK',
                'sektor' => 'Dkpp',
                'status' => 'Ditolak',
                'tanggal_permohonan' => '2025-01-07',
                'deadline' => '2025-02-06',
                'verifikator' => 'Gita Sari, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Ditolak',
            ],
            [
                'no_permohonan' => 'I-202504291626428624600',
                'nama_usaha' => 'UD. TIDAK MEMENUHI',
                'sektor' => 'Dlh',
                'status' => 'Ditolak',
                'tanggal_permohonan' => '2025-01-08',
                'deadline' => '2025-02-07',
                'verifikator' => 'Hendra Pratama, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Ditolak',
            ],

            // 7 Data Dikembalikan (MASIH PROSES)
            // 2 Data Dikembalikan TERLAMBAT
            [
                'no_permohonan' => 'I-202504291626428624601',
                'nama_usaha' => 'PT. PERLU PERBAIKAN',
                'sektor' => 'Disperinaker',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-01',
                'deadline' => '2025-01-15', // TERLAMBAT (deadline sudah lewat)
                'verifikator' => 'Indah Lestari, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624602',
                'nama_usaha' => 'CV. BELUM LENGKAP',
                'sektor' => 'Dinkopdag',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-02',
                'deadline' => '2025-01-16', // TERLAMBAT (deadline sudah lewat)
                'verifikator' => 'Joko Susilo, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],

            // 5 Data Dikembalikan NORMAL (tidak terlambat)
            [
                'no_permohonan' => 'I-202504291626428624603',
                'nama_usaha' => 'UD. SEDANG DIPERBAIKI',
                'sektor' => 'Disbudpar',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-20',
                'deadline' => '2025-02-20', // TIDAK TERLAMBAT (deadline belum lewat)
                'verifikator' => 'Ahmad Wijaya, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624604',
                'nama_usaha' => 'PT. MENUNGGU KELENGKAPAN',
                'sektor' => 'Dinkes',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-21',
                'deadline' => '2025-02-21', // TIDAK TERLAMBAT
                'verifikator' => 'Budi Santoso, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624605',
                'nama_usaha' => 'CV. PROSES PERBAIKAN',
                'sektor' => 'Dishub',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-22',
                'deadline' => '2025-02-22', // TIDAK TERLAMBAT
                'verifikator' => 'Citra Dewi, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624606',
                'nama_usaha' => 'UD. REVISI DOKUMEN',
                'sektor' => 'Dprkpp',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-23',
                'deadline' => '2025-02-23', // TIDAK TERLAMBAT
                'verifikator' => 'Dedi Kurniawan, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202504291626428624607',
                'nama_usaha' => 'PT. TAMBAHAN DATA',
                'sektor' => 'Dlh',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-24',
                'deadline' => '2025-02-24', // TIDAK TERLAMBAT
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
                'no_proyek' => 'PROJ-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'tanggal_permohonan' => $item['tanggal_permohonan'],
                'nib' => 'NIB' . str_pad($index + 1, 6, '0', STR_PAD_LEFT),
                'alamat_perusahaan' => 'Alamat ' . ($index + 1),
                'sektor' => $item['sektor'],
                'kbli' => 'KBLI-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'inputan_teks' => 'Inputan ' . ($index + 1),
                'modal_usaha' => 'Modal ' . ($index + 1),
                'jenis_proyek' => 'Jenis Proyek ' . ($index + 1),
                'nama_perizinan' => 'Perizinan ' . ($index + 1),
                'skala_usaha' => 'Skala ' . ($index + 1),
                'risiko' => 'Risiko ' . ($index + 1),
                'jangka_waktu' => 30,
                'no_telephone' => '08123456789' . $index,
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

        $this->command->info('Created ' . count($data) . ' permohonan records with correct logic:');
        $this->command->info('- 5 Diterima (Selesai)');
        $this->command->info('- 3 Ditolak (Selesai)');
        $this->command->info('- 7 Dikembalikan (5 Normal + 2 Terlambat)');
        $this->command->info('- Total: 15 data (status final)');
        $this->command->info('- Terlambat: 2 data (hanya dari Dikembalikan yang deadline lewat)');
    }
}
