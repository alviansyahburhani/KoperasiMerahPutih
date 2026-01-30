<?php

namespace App\Filament\Resources\LandingPageResource\Pages;

use App\Filament\Resources\LandingPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use App\Models\Central\LandingPage;

class ManageLandingPages extends ManageRecords
{
    protected static string $resource = LandingPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn () => LandingPage::count() === 0),
        ];
    }

    public function mount(): void
    {
        parent::mount();

        // Auto-create landing page jika belum ada
        if (LandingPage::count() === 0) {
            LandingPage::create([
                'hero_title' => 'Sistem Manajemen Koperasi Terintegrasi',
                'hero_subtitle' => 'Platform modern untuk mengelola koperasi Anda dengan mudah, cepat, dan efisien',
                'hero_cta_text' => 'Daftar Sekarang',
                'hero_cta_link' => '/daftar',
                'about_title' => 'Tentang Kami',
                'features_title' => 'Fitur Unggulan',
                'features_subtitle' => 'Solusi lengkap untuk kebutuhan manajemen koperasi modern',
                'contact_email' => 'info@koperasi.id',
                'contact_phone' => '021-12345678',
                'is_active' => true,
            ]);

            $this->redirect($this->getResource()::getUrl('index'));
        }
    }
}