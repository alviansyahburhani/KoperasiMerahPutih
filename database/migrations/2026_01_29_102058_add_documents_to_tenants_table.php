<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('dokumen_pengesahan')->nullable()->after('alamat');
            $table->string('dokumen_daftar_umum')->nullable()->after('dokumen_pengesahan');
            $table->string('dokumen_akte_notaris')->nullable()->after('dokumen_daftar_umum');
            $table->string('dokumen_npwp')->nullable()->after('dokumen_akte_notaris');
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn([
                'dokumen_pengesahan',
                'dokumen_daftar_umum',
                'dokumen_akte_notaris',
                'dokumen_npwp',
            ]);
        });
    }
};