<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permohonan;
use App\Models\PenerbitanBerkas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama terlebih dahulu
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('penerbitan_berkas')->truncate();
        DB::table('permohonans')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('🗑️  Data lama telah dihapus...');
        
        // Pastikan user sudah ada
        $users = User::all();
        if ($users->isEmpty()) {
            $this->command->error('❌ Tidak ada user di database. Jalankan UserSeeder terlebih dahulu!');
            return;
        }

        $dpmptspUser = $users->where('role', 'dpmptsp')->first();
        $pdTeknisUsers = $users->where('role', 'pd_teknis');
        $penerbitanUser = $users->where('role', 'penerbitan_berkas')->first();

        if (!$dpmptspUser) {
            $this->command->error('❌ User DPMPTSP tidak ditemukan! Pastikan UserSeeder sudah dijalankan.');
            return;
        }
        if (!$penerbitanUser) {
            $this->command->error('❌ User Penerbitan Berkas tidak ditemukan! Pastikan UserSeeder sudah dijalankan.');
            return;
        }

        $sektorList = ['Dinkopdag', 'Disbudpar', 'Dinkes', 'Dishub', 'Dprkpp', 'Dkpp', 'Dlh', 'Disperinaker'];
        $jenisPelakuUsaha = ['Orang Perseorangan', 'Badan Usaha'];
        $jenisBadanUsaha = ['PT', 'CV', 'UD', 'Firma', 'Koperasi', 'Persero'];
        $jenisProyek = ['Utama', 'Pendukung', 'Pendukung UMKU', 'Kantor Cabang'];
        $skalaUsaha = ['Mikro', 'Usaha Kecil', 'Usaha Menengah', 'Usaha Besar'];
        $risiko = ['Rendah', 'Menengah Rendah', 'Menengah Tinggi', 'Tinggi'];
        $statusPermohonan = ['Menunggu', 'Dikembalikan', 'Diterima', 'Ditolak', 'Terlambat'];
        $statusPenerbitan = ['Menunggu', 'Dikembalikan', 'Diterima', 'Ditolak'];

        $permohonans = [];

        // Buat 10 data Permohonan
        for ($i = 1; $i <= 10; $i++) {
            $sektor = $sektorList[array_rand($sektorList)];
            $pdTeknisUser = $pdTeknisUsers->where('sektor', $sektor)->first() ?? $pdTeknisUsers->random();
            
            $jenisPelaku = $jenisPelakuUsaha[array_rand($jenisPelakuUsaha)];
            $jenisBadan = ($jenisPelaku === 'Badan Usaha') ? $jenisBadanUsaha[array_rand($jenisBadanUsaha)] : null;

            $tanggalPermohonan = Carbon::now()->subDays(rand(1, 60));
            $jangkaWaktu = rand(2, 3); // Deadline 2-3 hari (real life)
            $deadline = $tanggalPermohonan->copy()->addDays($jangkaWaktu);
            
            $status = $statusPermohonan[array_rand($statusPermohonan)];
            
            // Generate nomor unik dengan timestamp
            $timestamp = time() + $i; // Tambahkan $i untuk memastikan unik
            $noPermohonan = 'PMH-' . str_pad($i, 6, '0', STR_PAD_LEFT) . '-' . $timestamp . '/' . date('Y');
            $noProyek = 'PRJ-' . str_pad($i, 4, '0', STR_PAD_LEFT) . '-' . $timestamp . '-' . date('Y');

            // Pastikan nama_perusahaan selalu terisi
            $namaPerusahaan = ($jenisPelaku === 'Badan Usaha') 
                ? $jenisBadan . ' ' . $this->getNamaUsaha($i)
                : $this->getNamaPemilik($i);

            // Tentukan verifikasi berdasarkan status
            $verifikasiDpmptsp = 'Menunggu Verifikasi';
            $verifikasiPdTeknis = 'Menunggu Verifikasi';
            
            if ($status === 'Diterima') {
                $verifikasiDpmptsp = 'Berkas Disetujui';
                $verifikasiPdTeknis = 'Berkas Disetujui';
            } elseif ($status === 'Dikembalikan') {
                $verifikasiDpmptsp = 'Berkas Diperbaiki';
                $verifikasiPdTeknis = 'Menunggu Verifikasi';
            } elseif ($status === 'Ditolak') {
                $verifikasiDpmptsp = 'Berkas Ditolak';
                $verifikasiPdTeknis = 'Berkas Ditolak';
            } elseif ($status === 'Terlambat') {
                $verifikasiDpmptsp = 'Berkas Diperbaiki';
                $verifikasiPdTeknis = 'Menunggu Verifikasi';
            }

            // Tentukan field tracking berdasarkan status
            $pengembalian = null;
            $keteranganPengembalian = null;
            $menghubungi = null;
            $keteranganMenghubungi = null;
            $statusMenghubungi = null;
            $perbaikan = null;
            $keteranganPerbaikan = null;
            $terbit = null;
            $keteranganTerbit = null;
            $pemrosesDanTglSurat = null;

            if ($status === 'Dikembalikan') {
                $pengembalian = $tanggalPermohonan->copy()->addDays(rand(1, 5));
                $keteranganPengembalian = 'Berkas perlu diperbaiki sesuai catatan yang diberikan';
                $menghubungi = $tanggalPermohonan->copy()->addDays(rand(6, 10));
                $keteranganMenghubungi = 'Sudah dihubungi untuk konfirmasi perbaikan berkas';
                $statusMenghubungi = 'Sudah Menghubungi Pemohon';
                $perbaikan = $tanggalPermohonan->copy()->addDays(rand(11, 15));
                $keteranganPerbaikan = 'Berkas telah diperbaiki sesuai catatan yang diberikan';
            } elseif ($status === 'Menunggu') {
                $menghubungi = $tanggalPermohonan->copy()->addDays(rand(6, 10));
                $keteranganMenghubungi = 'Sudah dihubungi untuk konfirmasi';
                $statusMenghubungi = 'Sudah Menghubungi Pemohon';
            } elseif ($status === 'Diterima') {
                // Tanggal terbit tidak melebihi deadline (2-3 hari)
                $terbit = $tanggalPermohonan->copy()->addDays(rand(1, $jangkaWaktu));
                $keteranganTerbit = 'Izin telah diterbitkan dan siap diambil';
                $pemrosesDanTglSurat = $pdTeknisUser->name . ' / ' . $terbit->format('d-m-Y');
            }

            $permohonan = Permohonan::create([
                'user_id' => $dpmptspUser->id,
                'no_permohonan' => $noPermohonan,
                'nama_usaha' => $this->getNamaUsaha($i),
                'nama_perusahaan' => $namaPerusahaan,
                'pemilik' => $this->getNamaPemilik($i),
                'jenis_perusahaan' => $jenisPelaku,
                'jenis_pelaku_usaha' => $jenisPelaku,
                'jenis_badan_usaha' => $jenisBadan,
                'nik' => $this->generateNIK(),
                'tanggal_permohonan' => $tanggalPermohonan,
                'nib' => $this->generateNIB(),
                'alamat_perusahaan' => $this->getAlamat($i),
                'sektor' => $sektor,
                'kbli' => $this->generateKBLI(),
                'inputan_teks' => $this->getInputanTeks($i),
                'modal_usaha' => rand(50000000, 5000000000),
                'jenis_proyek' => $jenisProyek[array_rand($jenisProyek)],
                'no_proyek' => $noProyek,
                'nama_perizinan' => $this->getNamaPerizinan($i),
                'skala_usaha' => $skalaUsaha[array_rand($skalaUsaha)],
                'risiko' => $risiko[array_rand($risiko)],
                'jangka_waktu' => $jangkaWaktu,
                'no_telephone' => $this->generatePhone(),
                'deadline' => $deadline,
                'verifikator' => $pdTeknisUser->name,
                'verifikasi_dpmptsp' => $verifikasiDpmptsp,
                'verifikasi_pd_teknis' => $verifikasiPdTeknis,
                'status' => $status,
                'pengembalian' => $pengembalian,
                'keterangan_pengembalian' => $keteranganPengembalian,
                'menghubungi' => $menghubungi,
                'keterangan_menghubungi' => $keteranganMenghubungi,
                'status_menghubungi' => $statusMenghubungi,
                'perbaikan' => $perbaikan,
                'keterangan_perbaikan' => $keteranganPerbaikan,
                'terbit' => $terbit,
                'keterangan_terbit' => $keteranganTerbit,
                'pemroses_dan_tgl_surat' => $pemrosesDanTglSurat,
                'keterangan' => 'Permohonan izin usaha untuk ' . $this->getNamaUsaha($i) . ' dengan jenis perizinan ' . $this->getNamaPerizinan($i),
            ]);

            $permohonans[] = $permohonan;
        }

        // Buat 10 data Penerbitan Berkas
        for ($i = 1; $i <= 10; $i++) {
            $permohonan = $permohonans[($i - 1) % count($permohonans)];
            
            // Gunakan data dari permohonan untuk konsistensi
            $jenisPelaku = $permohonan->jenis_pelaku_usaha;
            $jenisBadan = $permohonan->jenis_badan_usaha;

            $status = $statusPenerbitan[array_rand($statusPenerbitan)];
            $tanggalBAP = Carbon::now()->subDays(rand(1, 30));
            $nomorBAP = 'BAP/OSS/IX/I-' . date('Ymd') . str_pad($i, 3, '0', STR_PAD_LEFT) . '/' . rand(100, 999) . '.' . rand(1, 9) . '.' . rand(10, 99) . '/' . date('Y');

            // Pastikan pemroses_dan_tgl_surat selalu terisi berdasarkan status
            $pemrosesDanTglSurat = null;
            if ($status === 'Diterima') {
                $pemrosesDanTglSurat = $penerbitanUser->name . ' / ' . $tanggalBAP->format('d-m-Y');
            } elseif ($status === 'Dikembalikan') {
                $pemrosesDanTglSurat = $penerbitanUser->name . ' / ' . $tanggalBAP->format('d-m-Y');
            } elseif ($status === 'Ditolak') {
                $pemrosesDanTglSurat = $penerbitanUser->name . ' / ' . $tanggalBAP->format('d-m-Y');
            } else {
                $pemrosesDanTglSurat = 'Menunggu / -';
            }

            PenerbitanBerkas::create([
                'user_id' => $penerbitanUser->id,
                'permohonan_id' => $permohonan->id,
                'no_permohonan' => 'PB-' . str_pad($i, 6, '0', STR_PAD_LEFT) . '-' . (time() + $i) . '/' . date('Y'),
                'no_proyek' => $permohonan->no_proyek,
                'tanggal_permohonan' => $permohonan->tanggal_permohonan,
                'nib' => $permohonan->nib,
                'kbli' => $permohonan->kbli,
                'nama_usaha' => $permohonan->nama_usaha,
                'inputan_teks' => $permohonan->inputan_teks,
                'jenis_pelaku_usaha' => $jenisPelaku,
                'jenis_badan_usaha' => $jenisBadan,
                'pemilik' => $permohonan->pemilik,
                'modal_usaha' => $permohonan->modal_usaha,
                'alamat' => $this->getAlamat($i),
                'alamat_perusahaan' => $permohonan->alamat_perusahaan,
                'kegiatan' => $this->getKegiatan($i),
                'jenis_proyek' => $permohonan->jenis_proyek,
                'nama_perizinan' => $permohonan->nama_perizinan,
                'skala_usaha' => $permohonan->skala_usaha,
                'risiko' => $permohonan->risiko,
                'status' => $status,
                'pemroses_dan_tgl_surat' => $pemrosesDanTglSurat,
                'nomor_bap' => $nomorBAP,
                'tanggal_bap' => $tanggalBAP,
            ]);
        }

        $this->command->info('✅ 10 data Permohonan berhasil dibuat!');
        $this->command->info('✅ 10 data Penerbitan Berkas berhasil dibuat!');
    }

    private function getNamaUsaha($index): string
    {
        $nama = [
            'Surya Makmur', 'Bintang Jaya', 'Cahaya Abadi', 'Maju Bersama', 'Sejahtera Mandiri',
            'Karya Indah', 'Harmoni Sejahtera', 'Berkah Jaya', 'Sukses Makmur', 'Prima Sejahtera'
        ];
        return $nama[($index - 1) % count($nama)];
    }

    private function getNamaPemilik($index): string
    {
        $nama = [
            'Budi Santoso', 'Siti Nurhaliza', 'Ahmad Hidayat', 'Dewi Sartika', 'Rudi Hartono',
            'Maya Sari', 'Indra Gunawan', 'Ratna Dewi', 'Agus Setiawan', 'Lina Wijaya'
        ];
        return $nama[($index - 1) % count($nama)];
    }

    private function getAlamat($index): string
    {
        $alamat = [
            'Jl. Raya Darmo No. 123, Surabaya',
            'Jl. Diponegoro No. 45, Surabaya',
            'Jl. Pemuda No. 78, Surabaya',
            'Jl. Gubeng Raya No. 12, Surabaya',
            'Jl. Ahmad Yani No. 234, Surabaya',
            'Jl. Tunjungan No. 56, Surabaya',
            'Jl. Basuki Rahmat No. 89, Surabaya',
            'Jl. Mayjen Sungkono No. 34, Surabaya',
            'Jl. Raya Kupang No. 67, Surabaya',
            'Jl. HR Muhammad No. 90, Surabaya'
        ];
        return $alamat[($index - 1) % count($alamat)];
    }

    private function getNamaPerizinan($index): string
    {
        $perizinan = [
            'Izin Usaha Mikro Kecil (IUMK)',
            'Izin Mendirikan Bangunan (IMB)',
            'Izin Gangguan (HO)',
            'Izin Usaha Perdagangan (SIUP)',
            'Izin Tempat Usaha (ITU)',
            'Izin Usaha Jasa Konstruksi',
            'Izin Usaha Pariwisata',
            'Izin Usaha Kesehatan',
            'Izin Usaha Transportasi',
            'Izin Usaha Perindustrian'
        ];
        return $perizinan[($index - 1) % count($perizinan)];
    }

    private function getInputanTeks($index): string
    {
        $teks = [
            'Usaha perdagangan umum dengan fokus pada produk kebutuhan sehari-hari',
            'Usaha jasa konsultasi dan pelayanan profesional',
            'Usaha manufaktur dan produksi barang',
            'Usaha pariwisata dan perhotelan',
            'Usaha transportasi dan logistik',
            'Usaha konstruksi dan pembangunan',
            'Usaha kuliner dan restoran',
            'Usaha kesehatan dan farmasi',
            'Usaha teknologi dan digital',
            'Usaha pertanian dan perkebunan'
        ];
        return $teks[($index - 1) % count($teks)];
    }

    private function getKegiatan($index): string
    {
        $kegiatan = [
            'Perdagangan Barang dan Jasa',
            'Konsultasi dan Jasa Profesional',
            'Manufaktur dan Produksi',
            'Pariwisata dan Perhotelan',
            'Transportasi dan Logistik',
            'Konstruksi dan Pembangunan',
            'Kuliner dan Restoran',
            'Kesehatan dan Farmasi',
            'Teknologi dan Digital',
            'Pertanian dan Perkebunan'
        ];
        return $kegiatan[($index - 1) % count($kegiatan)];
    }

    private function generateNIK(): string
    {
        return '35' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT) . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT) . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }

    private function generateNIB(): string
    {
        // Generate 20 digit NIB
        $nib = '';
        for ($i = 0; $i < 20; $i++) {
            $nib .= rand(0, 9);
        }
        return $nib;
    }

    private function generateKBLI(): string
    {
        return rand(10000, 99999) . '.' . rand(10, 99) . '.' . rand(10, 99);
    }

    private function generatePhone(): string
    {
        return '08' . rand(100000000, 999999999);
    }
}
