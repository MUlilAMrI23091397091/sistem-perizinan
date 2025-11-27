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
            // Add indexes for search columns
            $table->index('no_permohonan');
            $table->index('nama_usaha');
            $table->index('nib');
            $table->index('kbli');
            $table->index('pemilik');
            $table->index('nama_perizinan');
            
            // Add composite indexes for common search patterns
            $table->index(['no_permohonan', 'status']);
            $table->index(['nama_usaha', 'status']);
            $table->index(['created_at', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropIndex('permohonans_no_permohonan_index');
            $table->dropIndex('permohonans_nama_usaha_index');
            $table->dropIndex('permohonans_nib_index');
            $table->dropIndex('permohonans_kbli_index');
            $table->dropIndex('permohonans_pemilik_index');
            $table->dropIndex('permohonans_nama_perizinan_index');
            $table->dropIndex('permohonans_no_permohonan_status_index');
            $table->dropIndex('permohonans_nama_usaha_status_index');
            $table->dropIndex('permohonans_created_at_status_index');
        });
    }
};
