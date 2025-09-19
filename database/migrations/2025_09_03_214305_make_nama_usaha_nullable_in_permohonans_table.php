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
            // Mengubah kolom agar boleh bernilai NULL
            $table->string('nama_usaha')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            // Mengembalikan ke aturan semula jika diperlukan (tidak boleh NULL)
            $table->string('nama_usaha')->nullable(false)->change();
        });
    }
};