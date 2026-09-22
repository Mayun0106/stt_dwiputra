<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->string('jenis_kelamin')->nullable()->after('alamat');
            $table->date('tanggal_bergabung')->nullable()->after('jenis_kelamin');
        });
    }

    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->dropColumn(['jenis_kelamin', 'tanggal_bergabung']);
        });
    }
};
