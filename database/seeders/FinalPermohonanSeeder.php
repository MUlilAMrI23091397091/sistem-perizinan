<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permohonan;
use App\Models\User;
use Carbon\Carbon;

class FinalPermohonanSeeder extends Seeder
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

        $this->command->info('Creating 30 permohonan records with correct format...');

        // Daftar sektor yang tersedia
        $sektors = ['Dinkopdag', 'Disbudpar', 'Dinkes', 'Dishub', 'Dprkpp', 'Dkpp', 'Dlh', 'Disperinaker'];

        // Data dengan format yang benar (tanpa awalan 0 yang bermasalah)
        $data = [
            // 10 Data Diterima (SELESAI)
            [
                'no_permohonan' => 'I-202501001',
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
                'no_permohonan' => 'I-202501002',
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
                'no_permohonan' => 'I-202501003',
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
                'no_permohonan' => 'I-202501004',
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
                'no_permohonan' => 'I-202501005',
                'nama_usaha' => 'UD. BERKAH MULIA',
                'sektor' => 'Dishub',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-05',
                'deadline' => '2025-02-04',
                'verifikator' => 'Eka Putri, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],
            [
                'no_permohonan' => 'I-202501006',
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
                'no_permohonan' => 'I-202501007',
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
                'no_permohonan' => 'I-202501008',
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
                'no_permohonan' => 'I-202501009',
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
                'no_permohonan' => 'I-202501010',
                'nama_usaha' => 'CV. LANCAR JAYA',
                'sektor' => 'Dprkpp',
                'status' => 'Diterima',
                'tanggal_permohonan' => '2025-01-14',
                'deadline' => '2025-02-14',
                'verifikator' => 'Eka Putri, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Disetujui',
                'verifikasi_dpmptsp' => 'Disetujui',
            ],

            // 6 Data Ditolak (SELESAI)
            [
                'no_permohonan' => 'I-202501011',
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
                'no_permohonan' => 'I-202501012',
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
                'no_permohonan' => 'I-202501013',
                'nama_usaha' => 'UD. TIDAK MEMENUHI',
                'sektor' => 'Dlh',
                'status' => 'Ditolak',
                'tanggal_permohonan' => '2025-01-08',
                'deadline' => '2025-02-07',
                'verifikator' => 'Hendra Pratama, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Ditolak',
            ],
            [
                'no_permohonan' => 'I-202501014',
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
                'no_permohonan' => 'I-202501015',
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
                'no_permohonan' => 'I-202501016',
                'nama_usaha' => 'CV. TIDAK MEMENUHI SYARAT',
                'sektor' => 'Disperinaker',
                'status' => 'Ditolak',
                'tanggal_permohonan' => '2025-01-17',
                'deadline' => '2025-02-17',
                'verifikator' => 'Hendra Pratama, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Ditolak',
            ],

            // 14 Data Dikembalikan (MASIH PROSES)
            // 5 Data Dikembalikan TERLAMBAT
            [
                'no_permohonan' => 'I-202501017',
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
                'no_permohonan' => 'I-202501018',
                'nama_usaha' => 'CV. BELUM LENGKAP',
                'sektor' => 'Dinkopdag',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-02',
                'deadline' => '2025-01-16', // TERLAMBAT (deadline sudah lewat)
                'verifikator' => 'Joko Susilo, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501019',
                'nama_usaha' => 'UD. SEDANG DIPERBAIKI',
                'sektor' => 'Disbudpar',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-20',
                'deadline' => '2025-01-18', // TERLAMBAT (deadline sudah lewat)
                'verifikator' => 'Ahmad Wijaya, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501020',
                'nama_usaha' => 'PT. MENUNGGU KELENGKAPAN',
                'sektor' => 'Dinkes',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-21',
                'deadline' => '2025-01-19', // TERLAMBAT (deadline sudah lewat)
                'verifikator' => 'Budi Santoso, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501021',
                'nama_usaha' => 'CV. PROSES PERBAIKAN',
                'sektor' => 'Dishub',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-22',
                'deadline' => '2025-01-20', // TERLAMBAT (deadline sudah lewat)
                'verifikator' => 'Citra Dewi, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],

            // 9 Data Dikembalikan NORMAL (tidak terlambat)
            [
                'no_permohonan' => 'I-202501022',
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
                'no_permohonan' => 'I-202501023',
                'nama_usaha' => 'PT. TAMBAHAN DATA',
                'sektor' => 'Dlh',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-24',
                'deadline' => '2025-02-24', // TIDAK TERLAMBAT
                'verifikator' => 'Eka Putri, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501024',
                'nama_usaha' => 'CV. PERLU REVISI BESAR',
                'sektor' => 'Dinkopdag',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-25',
                'deadline' => '2025-02-25', // TIDAK TERLAMBAT
                'verifikator' => 'Indah Lestari, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501025',
                'nama_usaha' => 'UD. BELUM LENGKAP SEMUA',
                'sektor' => 'Disbudpar',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-26',
                'deadline' => '2025-02-26', // TIDAK TERLAMBAT
                'verifikator' => 'Joko Susilo, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501026',
                'nama_usaha' => 'PT. SEDANG DIPERBAIKI LAGI',
                'sektor' => 'Dinkes',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-27',
                'deadline' => '2025-02-27', // TIDAK TERLAMBAT
                'verifikator' => 'Ahmad Wijaya, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501027',
                'nama_usaha' => 'CV. MENUNGGU KELENGKAPAN DOKUMEN',
                'sektor' => 'Dishub',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-28',
                'deadline' => '2025-02-28', // TIDAK TERLAMBAT
                'verifikator' => 'Budi Santoso, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501028',
                'nama_usaha' => 'UD. PROSES PERBAIKAN BERKAS',
                'sektor' => 'Dprkpp',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-29',
                'deadline' => '2025-03-01', // TIDAK TERLAMBAT
                'verifikator' => 'Citra Dewi, S.H.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501029',
                'nama_usaha' => 'PT. REVISI DOKUMEN LENGKAP',
                'sektor' => 'Dkpp',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-30',
                'deadline' => '2025-03-02', // TIDAK TERLAMBAT
                'verifikator' => 'Dedi Kurniawan, S.T.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
            [
                'no_permohonan' => 'I-202501030',
                'nama_usaha' => 'CV. TAMBAHAN DATA LENGKAP',
                'sektor' => 'Dlh',
                'status' => 'Dikembalikan',
                'tanggal_permohonan' => '2025-01-31',
                'deadline' => '2025-03-03', // TIDAK TERLAMBAT
                'verifikator' => 'Eka Putri, S.E.',
                'verifikasi_pd_teknis' => 'Berkas Diperbaiki',
                'verifikasi_dpmptsp' => 'Perlu Perbaikan',
            ],
        ];

        // Buat data permohonan dengan format yang benar
        foreach ($data as $index => $item) {
            $user = $users->random();
            
            Permohonan::create([
                'no_permohonan' => $item['no_permohonan'],
                'no_proyek' => 'PROJ-' . ($index + 1), // Format sederhana tanpa padding
                'tanggal_permohonan' => $item['tanggal_permohonan'],
                'nib' => 'NIB' . ($index + 1), // Format sederhana tanpa padding
                'alamat_perusahaan' => 'Jl. Contoh No. ' . ($index + 1),
                'sektor' => $item['sektor'],
                'kbli' => 'KBLI-' . ($index + 1), // Format sederhana tanpa padding
                'inputan_teks' => 'Kegiatan Usaha ' . ($index + 1),
                'modal_usaha' => 1000000 + ($index * 500000), // Format numerik yang benar
                'jenis_proyek' => 'Proyek ' . ($index + 1),
                'nama_perizinan' => 'Perizinan ' . ($index + 1),
                'skala_usaha' => 'Skala ' . ($index + 1),
                'risiko' => 'Risiko ' . ($index + 1),
                'jangka_waktu' => 30,
                'no_telephone' => '0812345678' . str_pad($index + 1, 2, '0', STR_PAD_LEFT), // Format yang benar
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

        $this->command->info('Created 30 permohonan records with correct format:');
        $this->command->info('- 10 Diterima (Selesai)');
        $this->command->info('- 6 Ditolak (Selesai)');
        $this->command->info('- 14 Dikembalikan (9 Normal + 5 Terlambat)');
        $this->command->info('- Total: 30 data');
        $this->command->info('- Terlambat: 5 data (hanya dari Dikembalikan yang deadline lewat)');
        $this->command->info('- Format: No leading zeros, proper numeric values');
    }
}
