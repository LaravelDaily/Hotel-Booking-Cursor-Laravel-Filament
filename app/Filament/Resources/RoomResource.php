<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('room_number')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('floor')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                Forms\Components\Select::make('room_type_id')
                    ->relationship('roomType', 'name')
                    ->required()
                    ->preload(),
                Forms\Components\Toggle::make('is_available')
                    ->required()
                    ->default(true),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('room_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('floor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roomType.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roomType.price_per_night')
                    ->money('USD')
                    ->sortable()
                    ->label('Price/Night'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('room_type')
                    ->relationship('roomType', 'name'),
                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('Availability'),
                Tables\Filters\SelectFilter::make('floor')
                    ->options(function () {
                        return Room::distinct()->pluck('floor', 'floor')->toArray();
                    }),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
} 