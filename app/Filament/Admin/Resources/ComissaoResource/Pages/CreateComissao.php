<?php

namespace App\Filament\Admin\Resources\ComissaoResource\Pages;

use App\Filament\Admin\Resources\ComissaoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateComissao extends CreateRecord
{
    protected static string $resource = ComissaoResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.comissoes-agente.index.index');
    }
}
