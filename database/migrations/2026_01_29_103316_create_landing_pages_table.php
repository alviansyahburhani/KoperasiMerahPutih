<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title')->default('Sistem Manajemen Koperasi Terintegrasi');
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_cta_text')->default('Daftar Sekarang');
            $table->string('hero_cta_link')->default('/register');
            
            // About Section
            $table->string('about_title')->default('Tentang Kami');
            $table->longText('about_content')->nullable();
            $table->string('about_image')->nullable();
            
            // Features Section
            $table->string('features_title')->default('Fitur Unggulan');
            $table->text('features_subtitle')->nullable();
            
            // Stats Section
            $table->integer('stat_koperasi')->default(0);
            $table->integer('stat_anggota')->default(0);
            $table->integer('stat_transaksi')->default(0);
            
            // Contact Section
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('contact_address')->nullable();
            $table->text('contact_maps')->nullable();
            
            // Social Media
            $table->string('social_facebook')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_linkedin')->nullable();
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            
            // Logo & Branding
            $table->string('logo')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('favicon')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};