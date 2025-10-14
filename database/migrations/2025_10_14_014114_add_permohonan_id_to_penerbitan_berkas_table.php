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
        Schema::table('penerbitan_berkas', function (Blueprint $table) {
            $table->foreignId('permohonan_id')->nullable()->after('user_id')->constrained()->cascadeOnDelete();
            $table->string('alamat')->nullable()->after('nama_usaha');
            $table->string('kegiatan')->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penerbitan_berkas', function (Blueprint $table) {
            $table->dropForeign(['permohonan_id']);
            $table->dropColumn(['permohonan_id', 'alamat', 'kegiatan']);
        });
    }
};
