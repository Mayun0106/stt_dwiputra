<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('jam')->nullable()->after('tanggal_selesai');
            $table->string('penanggung_jawab')->nullable()->after('jam');
            $table->string('foto_dokumentasi')->nullable()->after('penanggung_jawab');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn(['jam', 'penanggung_jawab', 'foto_dokumentasi']);
        });
    }
};
