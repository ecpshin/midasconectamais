<?php

namespace App\Filament\Admin\Resources\SituacaoResource\Pages;

use App\Filament\Admin\Resources\SituacaoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSituacao extends CreateRecord
{
    protected static string $resource = SituacaoResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.situacoes.index');
    }
}
