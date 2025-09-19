<?php

namespace Database\Seeders;

use App\Models\JenisUsaha;
use Illuminate\Database\Seeder;

class JenisUsahaSeeder extends Seeder
{
    public function run(): void
    {
        $jenisUsaha = [
            'Perseroan Terbatas (PT)',
            'Perseroan Terbatas (PT) Perorangan',
            'Persekutuan Komanditer (CV/Commanditaire Vennootschap)',
            'Persekutuan Firma (FA / Venootschap Onder Firma)',
            'Persekutuan Perdata',
            'Perusahaan Umum (Perum)',
            'Perusahaan Umum Daerah (Perumda)',
            'Badan Hukum Lainnya',
            'Koperasi',
            'Persekutuan dan Perkumpulan',
            'Yayasan',
            'Badan Layanan Umum',
            'BUM Desa',
            'BUM Desa Bersama',
        ];

        foreach ($jenisUsaha as $nama) {
            JenisUsaha::create(['nama' => $nama]);
        }
    }
}
