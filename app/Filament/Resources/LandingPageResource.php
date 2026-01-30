<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingPageResource\Pages;
use App\Models\Central\LandingPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LandingPageResource extends Resource
{
    protected static ?string $model = LandingPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static ?string $navigationLabel = 'Landing Page';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Landing Page Settings')
                    ->tabs([
                        // TAB 1: HERO SECTION
                        Forms\Components\Tabs\Tab::make('Hero Section')
                            ->icon('heroicon-o-star')
                            ->schema([
                                Forms\Components\Section::make('Hero Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title')
                                            ->label('Hero Title')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('Sistem Manajemen Koperasi Terintegrasi'),
                                        
                                        Forms\Components\Textarea::make('hero_subtitle')
                                            ->label('Hero Subtitle')
                                            ->required()
                                            ->rows(3)
                                            ->placeholder('Platform modern untuk mengelola koperasi Anda'),
                                        
                                        Forms\Components\FileUpload::make('hero_image')
                                            ->label('Hero Image')
                                            ->image()
                                            ->disk('public')
                                            ->directory('landing')
                                            ->maxSize(2048)
                                            ->imageEditor(),
                                        
                                        Forms\Components\TextInput::make('hero_cta_text')
                                            ->label('CTA Button Text')
                                            ->required()
                                            ->maxLength(50)
                                            ->placeholder('Daftar Sekarang'),
                                        
                                        Forms\Components\TextInput::make('hero_cta_link')
                                            ->label('CTA Button Link')
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('/daftar'),
                                    ])
                                    ->columns(2),
                            ]),

                        // TAB 2: ABOUT SECTION
                        Forms\Components\Tabs\Tab::make('About Section')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('About Content')
                                    ->schema([
                                        Forms\Components\TextInput::make('about_title')
                                            ->label('About Title')
                                            ->maxLength(255)
                                            ->placeholder('Tentang Kami'),
                                        
                                        Forms\Components\RichEditor::make('about_content')
                                            ->label('About Content')
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'bulletList',
                                                'orderedList',
                                            ])
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\FileUpload::make('about_image')
                                            ->label('About Image')
                                            ->image()
                                            ->disk('public')
                                            ->directory('landing')
                                            ->maxSize(2048)
                                            ->imageEditor(),
                                    ])
                                    ->columns(2),
                            ]),

                        // TAB 3: FEATURES SECTION
                        Forms\Components\Tabs\Tab::make('Features Section')
                            ->icon('heroicon-o-sparkles')
                            ->schema([
                                Forms\Components\Section::make('Features Header')
                                    ->schema([
                                        Forms\Components\TextInput::make('features_title')
                                            ->label('Features Title')
                                            ->maxLength(255)
                                            ->placeholder('Fitur Unggulan'),
                                        
                                        Forms\Components\Textarea::make('features_subtitle')
                                            ->label('Features Subtitle')
                                            ->rows(2)
                                            ->placeholder('Solusi lengkap untuk kebutuhan koperasi modern'),
                                    ])
                                    ->columns(2),
                            ]),

                        // TAB 4: CONTACT INFORMATION
                        Forms\Components\Tabs\Tab::make('Contact Information')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\Section::make('Kontak & Alamat')
                                    ->schema([
                                        Forms\Components\TextInput::make('contact_email')
                                            ->label('Email')
                                            ->email()
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder('info@koperasi.id')
                                            ->prefixIcon('heroicon-o-envelope'),
                                        
                                        Forms\Components\TextInput::make('contact_phone')
                                            ->label('Telepon Utama')
                                            ->tel()
                                            ->required()
                                            ->maxLength(20)
                                            ->placeholder('021-12345678')
                                            ->prefixIcon('heroicon-o-phone'),
                                        
                                        Forms\Components\TextInput::make('contact_phone_2')
                                            ->label('Telepon Alternatif')
                                            ->tel()
                                            ->maxLength(20)
                                            ->placeholder('021-87654321')
                                            ->prefixIcon('heroicon-o-phone'),
                                        
                                        Forms\Components\TextInput::make('contact_whatsapp')
                                            ->label('WhatsApp')
                                            ->tel()
                                            ->maxLength(20)
                                            ->placeholder('08123456789')
                                            ->prefixIcon('heroicon-o-chat-bubble-left-right')
                                            ->helperText('Format: 08xxx tanpa tanda +62'),
                                        
                                        Forms\Components\Textarea::make('contact_address')
                                            ->label('Alamat Lengkap')
                                            ->rows(3)
                                            ->placeholder('Jl. Raya Koperasi No. 123, Jakarta Selatan 12345')
                                            ->columnSpanFull(),
                                        
                                        Forms\Components\TextInput::make('office_hours')
                                            ->label('Jam Operasional')
                                            ->maxLength(255)
                                            ->placeholder('Senin - Jumat: 08:00 - 17:00 WIB')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                                
                                Forms\Components\Section::make('Google Maps')
                                    ->schema([
                                        Forms\Components\Textarea::make('contact_maps')
                                            ->label('Google Maps Embed Code')
                                            ->rows(4)
                                            ->placeholder('<iframe src="https://www.google.com/maps/embed?pb=..." ...></iframe>')
                                            ->helperText('Paste kode embed dari Google Maps')
                                            ->columnSpanFull(),
                                    ]),
                            ]),


                        // TAB 5: SOCIAL MEDIA
                        Forms\Components\Tabs\Tab::make('Social Media')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Forms\Components\Section::make('Social Media Links')
                                    ->schema([
                                        Forms\Components\TextInput::make('facebook_url')
                                            ->label('Facebook URL')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://facebook.com/username')
                                            ->prefixIcon('heroicon-o-link'),
                                        
                                        Forms\Components\TextInput::make('twitter_url')
                                            ->label('Twitter/X URL')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://twitter.com/username')
                                            ->prefixIcon('heroicon-o-link'),
                                        
                                        Forms\Components\TextInput::make('instagram_url')
                                            ->label('Instagram URL')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://instagram.com/username')
                                            ->prefixIcon('heroicon-o-link'),
                                        
                                        Forms\Components\TextInput::make('linkedin_url')
                                            ->label('LinkedIn URL')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://linkedin.com/company/username')
                                            ->prefixIcon('heroicon-o-link'),
                                    ])
                                    ->columns(2),
                            ]),

                        // TAB 6: SETTINGS
                        Forms\Components\Tabs\Tab::make('Settings')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Forms\Components\Section::make('General Settings')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Aktifkan Landing Page')
                                            ->default(true)
                                            ->helperText('Nonaktifkan untuk maintenance mode'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')
                    ->label('Hero Title')
                    ->searchable()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('contact_email')
                    ->label('Email')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('contact_phone')
                    ->label('Telepon'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLandingPages::route('/'),
        ];
    }
}