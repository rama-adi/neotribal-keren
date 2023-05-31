<?php

namespace App\Filament\Resources\LocationStarResource\Pages;

use App\Filament\Resources\LocationStarResource;
use App\Jobs\IngestToPinecone;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListLocationStars extends ListRecords
{
    protected static string $resource = LocationStarResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('ingest')
                ->label('Ingest to pinecone')
                ->action(function () {
                    IngestToPinecone::dispatch();
                })
                ->requiresConfirmation(),
        ];
    }
}
