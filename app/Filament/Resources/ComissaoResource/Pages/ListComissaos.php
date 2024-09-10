<?php

namespace App\Filament\Resources\ComissaoResource\Pages;

use App\Filament\Resources\ComissaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComissaos extends ListRecords
{
    protected static string $resource = ComissaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
