<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Mengubah definisi kolom enum untuk menambahkan role baru
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'pd_teknis', 'dpmptsp', 'penerbitan_berkas'])->default('pd_teknis')->change();
        });
    }

    public function down(): void
    {
        // (Langkah untuk membatalkan jika diperlukan)
        DB::table('users')->where('role', 'penerbitan_berkas')->delete();

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'pd_teknis', 'dpmptsp'])->default('pd_teknis')->change();
        });
    }
};