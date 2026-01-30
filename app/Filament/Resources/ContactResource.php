<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Central\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    
    protected static ?string $navigationLabel = 'Pesan Kontak';
    
    protected static ?string $navigationGroup = 'Content Management';
    
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengirim')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('phone')
                            ->label('No. Telepon')
                            ->tel()
                            ->maxLength(20)
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('subject')
                            ->label('Subject')
                            ->maxLength(255)
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pesan')
                    ->schema([
                        Forms\Components\Textarea::make('message')
                            ->label('Isi Pesan')
                            ->required()
                            ->rows(6)
                            ->disabled()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Status & Catatan')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'new' => 'Baru',
                                'read' => 'Sudah Dibaca',
                                'replied' => 'Sudah Dibalas',
                                'archived' => 'Diarsipkan',
                            ])
                            ->required()
                            ->default('new'),
                        
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Catatan Admin')
                            ->rows(4)
                            ->placeholder('Tulis catatan internal tentang pesan ini...')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Informasi')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Diterima Pada')
                            ->content(fn (Contact $record): string => $record->created_at->format('d F Y, H:i')),
                        
                        Forms\Components\Placeholder::make('ip_address')
                            ->label('IP Address')
                            ->content(fn (Contact $record): string => $record->ip_address ?? '-'),
                    ])
                    ->columns(2)
                    ->hidden(fn (?Contact $record) => $record === null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),
                
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable()
                    ->toggleable()
                    ->icon('heroicon-m-phone'),
                
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 40) {
                            return null;
                        }
                        return $state;
                    }),
                
                Tables\Columns\TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50)
                    ->searchable()
                    ->toggleable()
                    ->wrap(),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'new',
                        'info' => 'read',
                        'success' => 'replied',
                        'secondary' => 'archived',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'Baru',
                        'read' => 'Dibaca',
                        'replied' => 'Dibalas',
                        'archived' => 'Arsip',
                        default => $state,
                    })
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'new' => 'Baru',
                        'read' => 'Sudah Dibaca',
                        'replied' => 'Sudah Dibalas',
                        'archived' => 'Diarsipkan',
                    ])
                    ->default('new'),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['until'], fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('info'),
                    
                    Tables\Actions\EditAction::make()
                        ->color('warning'),
                    
                    Tables\Actions\Action::make('mark_as_read')
                        ->label('Tandai Dibaca')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->visible(fn (Contact $record) => $record->status === 'new')
                        ->action(function (Contact $record) {
                            $record->update(['status' => 'read']);
                            Notification::make()
                                ->success()
                                ->title('Status diperbarui')
                                ->body('Pesan ditandai sebagai sudah dibaca.')
                                ->send();
                        }),
                    
                    Tables\Actions\Action::make('mark_as_replied')
                        ->label('Tandai Dibalas')
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->color('success')
                        ->visible(fn (Contact $record) => $record->status !== 'replied')
                        ->action(function (Contact $record) {
                            $record->update(['status' => 'replied']);
                            Notification::make()
                                ->success()
                                ->title('Status diperbarui')
                                ->body('Pesan ditandai sebagai sudah dibalas.')
                                ->send();
                        }),
                    
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->label('Tandai Dibaca')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['status' => 'read']);
                            Notification::make()
                                ->success()
                                ->title('Pesan diperbarui')
                                ->body(count($records) . ' pesan ditandai sebagai sudah dibaca.')
                                ->send();
                        }),
                    
                    Tables\Actions\BulkAction::make('archive')
                        ->label('Arsipkan')
                        ->icon('heroicon-o-archive-box')
                        ->color('secondary')
                        ->action(function ($records) {
                            $records->each->update(['status' => 'archived']);
                            Notification::make()
                                ->success()
                                ->title('Pesan diarsipkan')
                                ->body(count($records) . ' pesan telah diarsipkan.')
                                ->send();
                        }),
                    
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count() ?: null;
    }
    
    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}