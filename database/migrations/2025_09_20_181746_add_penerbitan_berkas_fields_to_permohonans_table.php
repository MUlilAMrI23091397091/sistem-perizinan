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
            $table->string('pemilik')->nullable()->after('nama_usaha');
            $table->string('nama_perizinan')->nullable()->after('jenis_proyek');
            $table->string('skala_usaha')->nullable()->after('nama_perizinan');
            $table->string('risiko')->nullable()->after('skala_usaha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropColumn(['pemilik', 'nama_perizinan', 'skala_usaha', 'risiko']);
        });
    }
};