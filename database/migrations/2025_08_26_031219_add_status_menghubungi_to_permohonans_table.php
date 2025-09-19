<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            // Menambahkan kolom baru setelah 'keterangan_menghubungi'
            $table->string('status_menghubungi')->nullable()->after('keterangan_menghubungi');
        });
    }

    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropColumn('status_menghubungi');
        });
    }
};