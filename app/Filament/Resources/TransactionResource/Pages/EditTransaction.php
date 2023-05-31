<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\Action;
class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('Approve')
                ->action(function (){

                    $this->record->update([
                        'status' => 'completed'
                    ]);

                    User::whereId($this->record->user_id)
                        ->first()
                        ->increment('coins', $this->record->coins);
                })
                ->requiresConfirmation(),
        ];
    }
}
