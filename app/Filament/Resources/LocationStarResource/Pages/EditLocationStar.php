<?php

namespace App\Filament\Resources\LocationStarResource\Pages;

use App\Filament\Resources\LocationStarResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocationStar extends EditRecord
{
    protected static string $resource = LocationStarResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
