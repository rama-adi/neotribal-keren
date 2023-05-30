<?php

namespace App\Filament\Resources\StickerUserResource\Pages;

use App\Filament\Resources\StickerUserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStickerUser extends EditRecord
{
    protected static string $resource = StickerUserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
