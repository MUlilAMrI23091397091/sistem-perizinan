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
            $table->string('nomor_bap')->nullable()->after('status');
            $table->date('tanggal_bap')->nullable()->after('nomor_bap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penerbitan_berkas', function (Blueprint $table) {
            $table->dropColumn(['nomor_bap', 'tanggal_bap']);
        });
    }
};
