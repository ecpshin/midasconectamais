<?php

namespace App\Filament\Admin\Resources\PrefeituraResource\Pages;

use App\Filament\Admin\Resources\PrefeituraResource;
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
