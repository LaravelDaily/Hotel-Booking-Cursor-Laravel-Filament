<?php

namespace App\Filament\Resources\RoomTypeResource\Pages;

use App\Filament\Resources\RoomTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRoomType extends CreateRecord
{
    protected static string $resource = RoomTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 