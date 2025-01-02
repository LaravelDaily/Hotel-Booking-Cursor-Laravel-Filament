<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomTypeResource\Pages;
use App\Models\RoomType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class RoomTypeResource extends Resource
{
    protected static ?string $model = RoomType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                SpatieMediaLibraryFileUpload::make('photo')
                    ->collection('photo')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '3:2',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->rows(3),
                Forms\Components\TextInput::make('price_per_night')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->minValue(0),
                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(10),
                Forms\Components\TextInput::make('size')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->suffix('m²'),
                Forms\Components\CheckboxList::make('amenities')
                    ->relationship('amenities', 'name')
                    ->required()
                    ->columns(2)
                    ->gridDirection('row'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_per_night')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListRoomTypes::route('/'),
            'create' => Pages\CreateRoomType::route('/create'),
            'edit' => Pages\EditRoomType::route('/{record}/edit'),
        ];
    }
} 