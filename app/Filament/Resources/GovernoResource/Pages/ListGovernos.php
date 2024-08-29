<?php

namespace App\Filament\Resources\GovernoResource\Pages;

use App\Filament\Resources\GovernoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGovernos extends ListRecords
{
    protected static string $resource = GovernoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
