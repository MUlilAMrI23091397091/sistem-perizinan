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
            $table->string('masa_berlaku')->nullable()->after('risiko');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penerbitan_berkas', function (Blueprint $table) {
            $table->dropColumn('masa_berlaku');
        });
    }
};
