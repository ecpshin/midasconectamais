<?php

namespace App\Filament\Midas\Resources\GovernoResource\Pages;

use App\Filament\Midas\Resources\GovernoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGoverno extends EditRecord
{
    protected static string $resource = GovernoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
