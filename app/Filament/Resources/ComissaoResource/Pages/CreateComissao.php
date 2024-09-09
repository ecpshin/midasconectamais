<?php

namespace App\Filament\Resources\ComissaoResource\Pages;

use App\Filament\Resources\ComissaoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateComissao extends CreateRecord
{
    protected static string $resource = ComissaoResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.comissoes-agente.index.index');
    }
}
