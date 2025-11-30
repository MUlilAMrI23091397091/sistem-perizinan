<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'name' => 'Administrator Sistem',
            'email' => 'admin@dpmptsp.surabaya.go.id',
            'password' => Hash::make('Admin@2025'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Ahmad Hidayat',
            'email' => 'ptsp@dpmptsp.surabaya.go.id',
            'password' => Hash::make('Dpmptsp@2025'),
            'role' => 'dpmptsp',
        ]);

        User::create([
            'name' => 'Muhammad Rizki',
            'email' => 'pdteknis-dinkopdag@dpmptsp.surabaya.go.id',
            'password' => Hash::make('PdTeknis@2025'),
            'role' => 'pd_teknis',
            'sektor' => 'Dinkopdag',
        ]);

        User::create([
            'name' => 'Rina Kartika',
            'email' => 'penerbitan@dpmptsp.surabaya.go.id',
            'password' => Hash::make('Penerbitan@2025'),
            'role' => 'penerbitan_berkas',
        ]);

        $this->command->info('✅ User profesional berhasil dibuat!');
        $this->command->info('📧 Format email:');
        $this->command->info('   - Admin: admin@dpmptsp.surabaya.go.id');
        $this->command->info('   - DPMPTSP: ptsp@dpmptsp.surabaya.go.id');
        $this->command->info('   - PD Teknis: pdteknis-(sektor)@dpmptsp.surabaya.go.id');
        $this->command->info('   - Penerbitan: penerbitan@dpmptsp.surabaya.go.id');
        $this->command->info('🔑 Password default: [Role]@2025');
    }
}
