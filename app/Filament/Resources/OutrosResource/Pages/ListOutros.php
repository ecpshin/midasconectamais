<?php

namespace App\Filament\Resources\OutrosResource\Pages;

use App\Filament\Resources\OutrosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOutros extends ListRecords
{
    protected static string $resource = OutrosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
