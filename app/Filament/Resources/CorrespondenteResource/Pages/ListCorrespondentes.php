<?php

namespace App\Filament\Resources\CorrespondenteResource\Pages;

use App\Filament\Resources\CorrespondenteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCorrespondentes extends ListRecords
{
    protected static string $resource = CorrespondenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
