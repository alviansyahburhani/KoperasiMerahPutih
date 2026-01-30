<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set default status jika belum ada
        if (!isset($data['status'])) {
            $data['status'] = 'active';
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $tenant = $this->record;

        // Run tenant migrations
        try {
            \Artisan::call('tenants:migrate', [
                '--tenants' => [$tenant->id],
            ]);

            \Filament\Notifications\Notification::make()
                ->title('Tenant Created Successfully')
                ->body('Database migrations completed for ' . $tenant->nama_koperasi)
                ->success()
                ->send();
        } catch (\Exception $e) {
            \Filament\Notifications\Notification::make()
                ->title('Migration Warning')
                ->body('Tenant created but migrations failed: ' . $e->getMessage())
                ->warning()
                ->send();
        }
    }
}