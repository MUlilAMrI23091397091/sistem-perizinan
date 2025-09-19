<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->date('pengembalian')->nullable()->after('verifikasi_dpmptsp');
            $table->text('keterangan_pengembalian')->nullable()->after('pengembalian');
            $table->date('menghubungi')->nullable()->after('keterangan_pengembalian');
            $table->text('keterangan_menghubungi')->nullable()->after('menghubungi');
            $table->date('perbaikan')->nullable()->after('keterangan_menghubungi');
            $table->text('keterangan_perbaikan')->nullable()->after('perbaikan');
            $table->date('terbit')->nullable()->after('keterangan_perbaikan');
            $table->text('keterangan_terbit')->nullable()->after('terbit');
            $table->string('pemroses_dan_tgl_surat')->nullable()->after('keterangan_terbit');
            $table->string('verifikator')->nullable()->after('pemroses_dan_tgl_surat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropColumn([
                'pengembalian', 'keterangan_pengembalian', 'menghubungi', 
                'keterangan_menghubungi', 'perbaikan', 'keterangan_perbaikan', 
                'terbit', 'keterangan_terbit', 'pemroses_dan_tgl_surat', 'verifikator'
            ]);
        });
    }
};
