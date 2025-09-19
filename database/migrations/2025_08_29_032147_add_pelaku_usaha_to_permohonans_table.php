<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->string('jenis_pelaku_usaha')->nullable()->after('sektor');
            $table->string('nik', 16)->nullable()->after('jenis_pelaku_usaha');
        });
    }
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropColumn(['jenis_pelaku_usaha', 'nik']);
        });
    }
};