<?php

namespace App\Filament\Admin\Resources\GovernoResource\Pages;

use App\Filament\Admin\Resources\GovernoResource;
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
