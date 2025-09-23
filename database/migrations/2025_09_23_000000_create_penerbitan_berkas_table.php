<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penerbitan_berkas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('no_permohonan')->nullable()->unique();
            $table->string('no_proyek')->nullable();
            $table->date('tanggal_permohonan')->nullable();
            $table->string('nib', 20)->nullable();
            $table->string('kbli')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->text('inputan_teks')->nullable();
            $table->string('jenis_pelaku_usaha')->nullable();
            $table->string('jenis_badan_usaha')->nullable();
            $table->string('pemilik')->nullable();
            $table->decimal('modal_usaha', 16, 2)->nullable();
            $table->text('alamat_perusahaan')->nullable();
            $table->string('jenis_proyek')->nullable();
            $table->string('nama_perizinan')->nullable();
            $table->string('skala_usaha')->nullable();
            $table->string('risiko')->nullable();
            $table->enum('status', ['Dikembalikan','Diterima','Ditolak','Menunggu'])->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerbitan_berkas');
    }
};


