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
            // Mengubah semua kolom yang opsional di form agar boleh bernilai NULL
            $table->string('no_permohonan')->nullable()->change();
            $table->string('no_proyek')->nullable()->change();
            $table->date('tanggal_permohonan')->nullable()->change();
            $table->string('nib')->nullable()->change();
            $table->string('alamat_perusahaan')->nullable()->change();
            $table->string('modal_usaha')->nullable()->change();
            $table->string('jenis_proyek')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            // Mengembalikan ke aturan semula jika diperlukan (tidak boleh NULL)
            $table->string('no_permohonan')->nullable(false)->change();
            $table->string('no_proyek')->nullable(false)->change();
            $table->date('tanggal_permohonan')->nullable(false)->change();
            $table->string('nib')->nullable(false)->change();
            $table->string('alamat_perusahaan')->nullable(false)->change();
            $table->string('modal_usaha')->nullable(false)->change();
            $table->string('jenis_proyek')->nullable(false)->change();
        });
    }
};
