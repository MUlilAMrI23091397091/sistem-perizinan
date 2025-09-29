<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PdTeknisSectorSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus user PD Teknis yang sudah ada (tanpa sektor)
        User::where('role', 'pd_teknis')->whereNull('sektor')->delete();

        // Daftar sektor yang tersedia
        $sektors = [
            'Dinkopdag' => 'Dinas Koperasi dan Perdagangan',
            'Disbudpar' => 'Dinas Kebudayaan dan Pariwisata',
            'Dinkes' => 'Dinas Kesehatan',
            'Dishub' => 'Dinas Perhubungan',
            'Dprkpp' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak',
            'Dkpp' => 'Dinas Ketahanan Pangan dan Perikanan',
            'Dlh' => 'Dinas Lingkungan Hidup',
            'Disperinaker' => 'Dinas Perindustrian dan Tenaga Kerja'
        ];

        // Buat user PD Teknis untuk setiap sektor
        foreach ($sektors as $sektorCode => $sektorName) {
            User::create([
                'name' => "Staff PD Teknis {$sektorCode}",
                'email' => "teknis.{$sektorCode}@example.com",
                'password' => Hash::make('password'),
                'role' => 'pd_teknis',
                'sektor' => $sektorCode,
            ]);
        }

        $this->command->info('PD Teknis users with sectors created successfully!');
        $this->command->info('Total PD Teknis users: ' . User::where('role', 'pd_teknis')->count());
    }
}