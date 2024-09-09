<?php

namespace App\Filament\Resources\OrganizacaoResource\Pages;

use App\Filament\Resources\OrganizacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganizacao extends EditRecord
{
    protected static string $resource = OrganizacaoResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.orgaos.index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
