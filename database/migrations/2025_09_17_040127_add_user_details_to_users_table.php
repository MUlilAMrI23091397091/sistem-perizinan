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
            $table->string('jenis_pelaku_usaha')->nullable()->after('role');
            $table->string('nik', 16)->nullable()->after('jenis_pelaku_usaha');
            $table->string('npwp', 20)->nullable()->after('nik');
            $table->text('alamat')->nullable()->after('npwp');
            $table->string('no_telepon')->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_pelaku_usaha',
                'nik',
                'npwp',
                'alamat',
                'no_telepon'
            ]);
        });
    }
};
