<?php

namespace App\Filament\Admin\Resources\ComissaoResource\Pages;

use App\Filament\Admin\Resources\ComissaoResource;
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
