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
        Schema::create('ttd_settings', function (Blueprint $table) {
            $table->id();
            $table->string('mengetahui_title')->default('Mengetahui');
            $table->string('mengetahui_jabatan')->default('Koordinator Ketua Tim Kerja');
            $table->string('mengetahui_unit')->default('Pelayanan Terpadu Satu Pintu');
            $table->string('mengetahui_nama')->default('Yohanes Franklin, S.H.');
            $table->string('mengetahui_pangkat')->default('Penata Tk.1');
            $table->string('mengetahui_nip')->default('198502182010011008');
            
            $table->string('menyetujui_title')->default('Surabaya, {{ date("d F Y") }}');
            $table->string('menyetujui_jabatan')->default('Ketua Tim Kerja Pelayanan Perizinan Berusaha');
            $table->string('menyetujui_nama')->default('Ulvia Zulvia, ST');
            $table->string('menyetujui_pangkat')->default('Penata Tk. 1');
            $table->string('menyetujui_nip')->default('197710132006042012');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ttd_settings');
    }
};