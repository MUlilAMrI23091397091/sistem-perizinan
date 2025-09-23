<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PenerbitanBerkas;
use App\Models\User;
use Carbon\Carbon;

class PenerbitanBerkasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user dengan role penerbitan_berkas
        $user = User::where('role', 'penerbitan_berkas')->first();
        
        if (!$user) {
            $this->command->info('User dengan role penerbitan_berkas tidak ditemukan. Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        $kbliCodes = ['52101', '46631', '52109', '46900', '47111', '47211', '47301', '47411'];
        $statuses = ['Diterima', 'Dikembalikan', 'Ditolak', 'Menunggu'];
        $jenisProyek = ['Utama', 'Pendukung', 'Pendukung UMKU', 'Kantor Cabang'];
        $jenisPelakuUsaha = ['Orang Perseorangan', 'Badan Usaha'];
        $jenisBadanUsaha = [
            'Perseroan Terbatas (PT)',
            'Perseroan Komanditer (CV)',
            'Firma (Fa)',
            'Persekutuan Perdata',
            'Koperasi',
            'Yayasan',
            'Perusahaan Perseorangan'
        ];

        $rows = [];

        for ($i = 1; $i <= 20; $i++) {
            $tanggal = Carbon::now()->subDays(rand(0, 45));
            $jenisPelaku = $jenisPelakuUsaha[array_rand($jenisPelakuUsaha)];
            $noPermohonan = 'PB-' . date('Ymd') . '-' . str_pad((string)$i, 4, '0', STR_PAD_LEFT);

            $rows[] = [
                'user_id' => $user->id,
                'no_permohonan' => $noPermohonan,
                'no_proyek' => 'PROJ-' . str_pad((string)$i, 5, '0', STR_PAD_LEFT),
                'tanggal_permohonan' => $tanggal->toDateString(),
                'nib' => 'NIB' . str_pad((string)$i, 10, '0', STR_PAD_LEFT),
                'kbli' => $kbliCodes[array_rand($kbliCodes)],
                'nama_usaha' => 'Usaha Penerbitan Berkas ' . $i,
                'inputan_teks' => 'Kegiatan Penerbitan Berkas ' . $i,
                'jenis_pelaku_usaha' => $jenisPelaku,
                'jenis_badan_usaha' => $jenisPelaku === 'Badan Usaha' ? $jenisBadanUsaha[array_rand($jenisBadanUsaha)] : null,
                'pemilik' => 'Pemilik PB ' . $i,
                'modal_usaha' => rand(5_000_000, 2_000_000_000),
                'alamat_perusahaan' => 'Jl. Penerbitan Berkas No. ' . $i . ', Surabaya',
                'jenis_proyek' => $jenisProyek[array_rand($jenisProyek)],
                'nama_perizinan' => 'Perizinan PB ' . $i,
                'skala_usaha' => ['Mikro', 'Usaha Kecil', 'Usaha Menengah', 'Usaha Besar'][array_rand([0,1,2,3])],
                'risiko' => ['Rendah', 'Menengah Rendah', 'Menengah Tinggi', 'Tinggi'][array_rand([0,1,2,3])],
                'status' => $statuses[array_rand($statuses)],
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ];
        }

        PenerbitanBerkas::insert($rows);

        $this->command->info('Berhasil membuat 20 data dummy untuk tabel penerbitan_berkas');
    }
}
