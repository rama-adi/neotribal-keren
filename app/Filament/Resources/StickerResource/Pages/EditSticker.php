<?php

namespace App\Filament\Resources\StickerResource\Pages;

use App\Filament\Resources\StickerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSticker extends EditRecord
{
    protected static string $resource = StickerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
