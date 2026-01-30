<?php

namespace App\Models\Central;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'hero_cta_text',
        'hero_cta_link',
        'about_title',
        'about_content',
        'about_image',
        'features_title',
        'features_subtitle',
        'stat_koperasi',
        'stat_anggota',
        'stat_transaksi',
        'contact_email',
        'contact_phone',
        'contact_phone_2',      // NEW ✅
        'contact_whatsapp',     // NEW ✅
        'contact_address',      
        'contact_maps',         
        'office_hours',         // NEW ✅
        'social_facebook',
        'social_instagram',
        'social_twitter',
        'social_youtube',
        'social_linkedin',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'logo',
        'logo_dark',
        'favicon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}