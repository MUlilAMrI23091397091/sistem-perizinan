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
            // Add indexes for frequently queried columns
            $table->index('status');
            $table->index('sektor');
            $table->index('created_at');
            $table->index('deadline');
            $table->index(['status', 'created_at']);
            $table->index(['sektor', 'status']);
            $table->index(['user_id', 'status']);
        });

        Schema::table('users', function (Blueprint $table) {
            // Add indexes for user queries
            $table->index('role');
            $table->index('sektor');
            $table->index(['role', 'sektor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->dropIndex('permohonans_status_index');
            $table->dropIndex('permohonans_sektor_index');
            $table->dropIndex('permohonans_created_at_index');
            $table->dropIndex('permohonans_deadline_index');
            $table->dropIndex('permohonans_status_created_at_index');
            $table->dropIndex('permohonans_sektor_status_index');
            $table->dropIndex('permohonans_user_id_status_index');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_role_index');
            $table->dropIndex('users_sektor_index');
            $table->dropIndex('users_role_sektor_index');
        });
    }
};
