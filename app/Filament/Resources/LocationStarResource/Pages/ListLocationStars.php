<?php

namespace App\Filament\Resources\LocationStarResource\Pages;

use App\Filament\Resources\LocationStarResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLocationStars extends ListRecords
{
    protected static string $resource = LocationStarResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
