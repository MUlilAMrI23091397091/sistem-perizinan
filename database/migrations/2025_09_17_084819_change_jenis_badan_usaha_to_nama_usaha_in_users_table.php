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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('jenis_badan_usaha');
            $table->string('nama_usaha')->nullable()->after('jenis_pelaku_usaha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nama_usaha');
            $table->string('jenis_badan_usaha')->nullable()->after('jenis_pelaku_usaha');
        });
    }
};
