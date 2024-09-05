<?php

namespace App\Filament\Midas\Resources\GovernoResource\Pages;

use App\Filament\Midas\Resources\GovernoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGovernos extends ListRecords
{
    protected static string $resource = GovernoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
