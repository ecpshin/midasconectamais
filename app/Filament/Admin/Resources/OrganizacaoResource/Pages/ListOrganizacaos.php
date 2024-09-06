<?php

namespace App\Filament\Resources\OrganizacaoResource\Pages;

use App\Filament\Resources\OrganizacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrganizacaos extends ListRecords
{
    protected static string $resource = OrganizacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
