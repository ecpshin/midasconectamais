<?php

namespace App\Filament\Resources\CorrespondenteResource\Pages;

use App\Filament\Resources\CorrespondenteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCorrespondente extends EditRecord
{
    protected static string $resource = CorrespondenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
