<?php

namespace App\Filament\Admin\Resources\OrganizacaoResource\Pages;

use App\Filament\Admin\Resources\OrganizacaoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrganizacao extends CreateRecord
{
    protected static string $resource = OrganizacaoResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.orgaos.index');
    }
}
