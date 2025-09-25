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
        Schema::table('log_permohonans', function (Blueprint $table) {
            $table->string('action')->nullable()->after('user_id');
            $table->json('old_data')->nullable()->after('keterangan');
            $table->json('new_data')->nullable()->after('old_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_permohonans', function (Blueprint $table) {
            $table->dropColumn(['action', 'old_data', 'new_data']);
        });
    }
};