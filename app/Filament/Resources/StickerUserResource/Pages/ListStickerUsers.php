<?php

namespace App\Filament\Resources\StickerUserResource\Pages;

use App\Filament\Resources\StickerUserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStickerUsers extends ListRecords
{
    protected static string $resource = StickerUserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
