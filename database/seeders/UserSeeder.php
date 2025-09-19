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

        // User Staff PD Teknis
        User::create([
            'name' => 'Staff PD Teknis',
            'email' => 'teknis@example.com',
            'password' => Hash::make('password'),
            'role' => 'pd_teknis',
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
