<?php

namespace App\Filament\Resources\PrefeituraResource\Pages;

use App\Filament\Resources\PrefeituraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrefeituras extends ListRecords
{
    protected static string $resource = PrefeituraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
