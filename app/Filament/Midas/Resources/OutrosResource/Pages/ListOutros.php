<?php

namespace App\Filament\Midas\Resources\OutrosResource\Pages;

use App\Filament\Midas\Resources\OutrosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOutros extends ListRecords
{
    protected static string $resource = OutrosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
