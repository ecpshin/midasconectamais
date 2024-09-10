<?php

namespace App\Filament\Admin\Resources\TabelaResource\Pages;

use App\Filament\Admin\Resources\TabelaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTabela extends CreateRecord
{
    protected static string $resource = TabelaResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.tabela.index');
    }
}
