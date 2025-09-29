<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // User Staff PD Teknis - Dinkopdag
        User::create([
            'name' => 'Staff PD Teknis Dinkopdag',
            'email' => 'teknis.dinkopdag@example.com',
            'password' => Hash::make('password'),
            'role' => 'pd_teknis',
            'sektor' => 'Dinkopdag',
        ]);

        // User Staff PD Teknis - Disbudpar
        User::create([
            'name' => 'Staff PD Teknis Disbudpar',
            'email' => 'teknis.disbudpar@example.com',
            'password' => Hash::make('password'),
            'role' => 'pd_teknis',
            'sektor' => 'Disbudpar',
        ]);

        // User Staff PD Teknis - Dinkes
        User::create([
            'name' => 'Staff PD Teknis Dinkes',
            'email' => 'teknis.dinkes@example.com',
            'password' => Hash::make('password'),
            'role' => 'pd_teknis',
            'sektor' => 'Dinkes',
        ]);

        // User Staff PD Teknis - Dishub
        User::create([
            'name' => 'Staff PD Teknis Dishub',
            'email' => 'teknis.dishub@example.com',
            'password' => Hash::make('password'),
            'role' => 'pd_teknis',
            'sektor' => 'Dishub',
        ]);

        // User Staff PD Teknis - Dprkpp
        User::create([
            'name' => 'Staff PD Teknis Dprkpp',
            'email' => 'teknis.dprkpp@example.com',
            'password' => Hash::make('password'),
            'role' => 'pd_teknis',
            'sektor' => 'Dprkpp',
        ]);

        // User Staff PD Teknis - Dkpp
        User::create([
            'name' => 'Staff PD Teknis Dkpp',
            'email' => 'teknis.dkpp@example.com',
            'password' => Hash::make('password'),
            'role' => 'pd_teknis',
            'sektor' => 'Dkpp',
        ]);

        // User Staff PD Teknis - Dlh
        User::create([
            'name' => 'Staff PD Teknis Dlh',
            'email' => 'teknis.dlh@example.com',
            'password' => Hash::make('password'),
            'role' => 'pd_teknis',
            'sektor' => 'Dlh',
        ]);

        // User Staff PD Teknis - Disperinaker
        User::create([
            'name' => 'Staff PD Teknis Disperinaker',
            'email' => 'teknis.disperinaker@example.com',
            'password' => Hash::make('password'),
            'role' => 'pd_teknis',
            'sektor' => 'Disperinaker',
        ]);

        // User Staff DPMPTSP (✅ sudah benar, bukan dpmtsp)
        User::create([
            'name' => 'Staff DPMPTSP',
            'email' => 'dpm@example.com',
            'password' => Hash::make('password'),
            'role' => 'dpmptsp',
        ]);

        // User Staff Penerbitan Berkas
        User::create([
            'name' => 'Staff Penerbitan Berkas',
            'email' => 'penerbitan@example.com',
            'password' => Hash::make('password'),
            'role' => 'penerbitan_berkas',
        ]);
    }
}
