<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Models\Central\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    
    protected static ?string $navigationLabel = 'Koperasi';
    
    protected static ?string $modelLabel = 'Koperasi';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Koperasi')
                    ->description('Data dasar koperasi')
                    ->schema([
                        Forms\Components\TextInput::make('nama_koperasi')
                            ->label('Nama Koperasi')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                if ($state) {
                                    $set('subdomain', Str::slug($state));
                                }
                            }),
                        
                        Forms\Components\TextInput::make('subdomain')
                            ->label('Subdomain')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Contoh: koperasi-makmur akan jadi koperasi-makmur.localhost')
                            ->prefix('https://')
                            ->suffix('.localhost'),
                        
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('phone')
                            ->label('No. Telepon')
                            ->tel()
                            ->maxLength(20),
                        
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->rows(3)
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'active' => 'Active',
                                'suspended' => 'Suspended',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Dokumen Koperasi')
                    ->description('Upload dokumen legalitas dan administrasi koperasi')
                    ->schema([
                        Forms\Components\FileUpload::make('dokumen_pengesahan')
                            ->label('Pengesahan Pendirian Badan Hukum')
                            ->disk('public')
                            ->directory('tenant-documents/pengesahan')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120) // 5MB
                            ->helperText('Format: PDF atau gambar. Maksimal 5MB')
                            ->downloadable()
                            ->openable()
                            ->previewable(true),
                        
                        Forms\Components\FileUpload::make('dokumen_daftar_umum')
                            ->label('Daftar Umum Koperasi')
                            ->disk('public')
                            ->directory('tenant-documents/daftar-umum')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120)
                            ->helperText('Format: PDF atau gambar. Maksimal 5MB')
                            ->downloadable()
                            ->openable()
                            ->previewable(true),
                        
                        Forms\Components\FileUpload::make('dokumen_akte_notaris')
                            ->label('Akte Notaris Pendirian')
                            ->disk('public')
                            ->directory('tenant-documents/akte-notaris')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120)
                            ->helperText('Format: PDF atau gambar. Maksimal 5MB')
                            ->downloadable()
                            ->openable()
                            ->previewable(true),
                        
                        Forms\Components\FileUpload::make('dokumen_npwp')
                            ->label('NPWP Koperasi')
                            ->disk('public')
                            ->directory('tenant-documents/npwp')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120)
                            ->helperText('Format: PDF atau gambar. Maksimal 5MB')
                            ->downloadable()
                            ->openable()
                            ->previewable(true),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->collapsed(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_koperasi')
                    ->label('Nama Koperasi')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('subdomain')
                    ->label('Subdomain')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => $state . '.localhost')
                    ->copyable()
                    ->copyMessage('Subdomain copied!')
                    ->url(fn ($record) => 'http://' . $record->subdomain . '.localhost:8000/app')
                    ->openUrlInNewTab()
                    ->color('primary'),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->icon('heroicon-m-phone')
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('documents_complete')
                    ->label('Dokumen')
                    ->boolean()
                    ->getStateUsing(function ($record) {
                        return $record->dokumen_pengesahan 
                            && $record->dokumen_daftar_umum 
                            && $record->dokumen_akte_notaris 
                            && $record->dokumen_npwp;
                    })
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('warning'),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'active',
                        'danger' => 'suspended',
                        'secondary' => 'rejected',
                    ]),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'suspended' => 'Suspended',
                        'rejected' => 'Rejected',
                    ]),
                
                Tables\Filters\TernaryFilter::make('documents_complete')
                    ->label('Dokumen Lengkap')
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('dokumen_pengesahan')
                            ->whereNotNull('dokumen_daftar_umum')
                            ->whereNotNull('dokumen_akte_notaris')
                            ->whereNotNull('dokumen_npwp'),
                        false: fn ($query) => $query->where(function ($q) {
                            $q->whereNull('dokumen_pengesahan')
                                ->orWhereNull('dokumen_daftar_umum')
                                ->orWhereNull('dokumen_akte_notaris')
                                ->orWhereNull('dokumen_npwp');
                        }),
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('view_documents')
                    ->label('Lihat Dokumen')
                    ->icon('heroicon-o-document-text')
                    ->color('info')
                    ->modalHeading('Dokumen Koperasi')
                    ->modalContent(fn ($record) => view('filament.resources.tenant.view-documents', ['record' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
                
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'active',
                            'approved_at' => now(),
                        ]);
                    }),
                
                Tables\Actions\Action::make('suspend')
                    ->label('Suspend')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'active')
                    ->action(fn ($record) => $record->update(['status' => 'suspended'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }
}