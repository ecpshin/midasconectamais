<?php

namespace App\Filament\Resources\PrefeituraResource\Pages;

use App\Filament\Resources\PrefeituraResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrefeitura extends EditRecord
{
    protected static string $resource = PrefeituraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
