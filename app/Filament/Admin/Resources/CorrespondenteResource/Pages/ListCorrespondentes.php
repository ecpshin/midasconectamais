<?php

namespace App\Filament\Admin\Resources\CorrespondenteResource\Pages;

use App\Filament\Admin\Resources\CorrespondenteResource;
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
