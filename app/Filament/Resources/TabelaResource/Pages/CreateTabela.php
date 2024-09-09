<?php

namespace App\Filament\Resources\TabelaResource\Pages;

use App\Filament\Resources\TabelaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTabela extends CreateRecord
{
    protected static string $resource = TabelaResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.tabela.index');
    }
}
