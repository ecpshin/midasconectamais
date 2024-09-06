<?php

namespace App\Filament\Admin\Resources\OrganizacaoResource\Pages;

use App\Filament\Admin\Resources\OrganizacaoResource;
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
