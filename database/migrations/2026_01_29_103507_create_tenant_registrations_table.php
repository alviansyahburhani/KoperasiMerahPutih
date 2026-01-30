<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenant_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_koperasi');
            $table->string('subdomain')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('alamat');
            
            // Kontak Person
            $table->string('pic_name');
            $table->string('pic_position');
            $table->string('pic_phone');
            $table->string('pic_email');
            
            // Dokumen (upload nanti setelah approval)
            $table->string('dokumen_pengesahan')->nullable();
            $table->string('dokumen_daftar_umum')->nullable();
            $table->string('dokumen_akte_notaris')->nullable();
            $table->string('dokumen_npwp')->nullable();
            
            // Package
            $table->foreignId('package_id')->nullable()->constrained('packages')->nullOnDelete();
            
            // Status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            
            // Tenant ID (setelah diapprove & tenant dibuat)
            $table->string('tenant_id')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_registrations');
    }
};