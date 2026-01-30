<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            // Hanya tambahkan kolom yang BELUM ada
            
            if (!Schema::hasColumn('landing_pages', 'contact_phone_2')) {
                $table->string('contact_phone_2', 20)->nullable()->after('contact_phone');
            }
            
            if (!Schema::hasColumn('landing_pages', 'contact_whatsapp')) {
                $table->string('contact_whatsapp', 20)->nullable()->after('contact_phone_2');
            }
            
            if (!Schema::hasColumn('landing_pages', 'office_hours')) {
                $table->string('office_hours')->nullable()->after('contact_whatsapp');
            }
        });
    }

    public function down(): void
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            if (Schema::hasColumn('landing_pages', 'contact_phone_2')) {
                $table->dropColumn('contact_phone_2');
            }
            
            if (Schema::hasColumn('landing_pages', 'contact_whatsapp')) {
                $table->dropColumn('contact_whatsapp');
            }
            
            if (Schema::hasColumn('landing_pages', 'office_hours')) {
                $table->dropColumn('office_hours');
            }
        });
    }
};