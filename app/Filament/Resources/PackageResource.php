<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Central\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    
    protected static ?string $navigationLabel = 'Paket Harga';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Paket')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Paket')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => 
                                $set('slug', \Illuminate\Support\Str::slug($state))
                            ),
                        
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                        
                        Forms\Components\Select::make('billing_period')
                            ->label('Periode Billing')
                            ->options([
                                'monthly' => 'Bulanan',
                                'yearly' => 'Tahunan',
                                'lifetime' => 'Selamanya',
                            ])
                            ->required()
                            ->default('monthly'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Fitur Paket')
                    ->schema([
                        Forms\Components\Repeater::make('features')
                            ->label('Daftar Fitur')
                            ->simple(
                                Forms\Components\TextInput::make('feature')
                                    ->label('Fitur')
                                    ->required()
                            )
                            ->defaultItems(3)
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('max_users')
                            ->label('Maksimal User')
                            ->numeric()
                            ->suffix('users')
                            ->helperText('Kosongkan untuk unlimited'),
                        
                        Forms\Components\TextInput::make('max_storage')
                            ->label('Maksimal Storage')
                            ->numeric()
                            ->suffix('MB')
                            ->helperText('Kosongkan untuk unlimited'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Toggle::make('is_popular')
                            ->label('Tandai sebagai Popular')
                            ->helperText('Paket ini akan ditampilkan dengan badge "Popular"'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampilan (kecil ke besar)'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Paket')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('billing_period')
                    ->label('Periode')
                    ->badge()
                    ->colors([
                        'info' => 'monthly',
                        'success' => 'yearly',
                        'warning' => 'lifetime',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'monthly' => 'Bulanan',
                        'yearly' => 'Tahunan',
                        'lifetime' => 'Selamanya',
                        default => $state,
                    }),
                
                Tables\Columns\IconColumn::make('is_popular')
                    ->label('Popular')
                    ->boolean(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
                
                Tables\Filters\TernaryFilter::make('is_popular')
                    ->label('Popular'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}