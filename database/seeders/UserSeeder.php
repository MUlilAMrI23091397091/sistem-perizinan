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
            'name' => 'admin',
            'email' => 'admin@dpmptsp.surabaya.go.id',
            'password' => Hash::make('Admin@2025'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'nama1',
            'email' => 'nama1@dpmptsp.surabaya.go.id',
            'password' => Hash::make('Dpmptsp@2025'),
            'role' => 'dpmptsp',
        ]);

        $sektorList = [
            'Dinkopdag' => 'nama2',
            'Disbudpar' => 'nama3',
            'Dinkes' => 'nama4',
            'Dishub' => 'nama5',
            'Dprkpp' => 'nama6',
            'Dkpp' => 'nama7',
            'Dlh' => 'nama8',
            'Disperinaker' => 'nama9',
        ];

        foreach ($sektorList as $sektor => $name) {
            User::create([
                'name' => $name,
                'email' => $name . '@dpmptsp.surabaya.go.id',
                'password' => Hash::make('PdTeknis@2025'),
                'role' => 'pd_teknis',
                'sektor' => $sektor,
            ]);
        }

        User::create([
            'name' => 'nama10',
            'email' => 'nama10@dpmptsp.surabaya.go.id',
            'password' => Hash::make('Penerbitan@2025'),
            'role' => 'penerbitan_berkas',
        ]);

        $this->command->info('✅ User berhasil dibuat!');
        $this->command->info('📧 Format email: nama@dpmptsp.surabaya.go.id');
        $this->command->info('🔑 Password default: [Role]@2025');
    }
}
