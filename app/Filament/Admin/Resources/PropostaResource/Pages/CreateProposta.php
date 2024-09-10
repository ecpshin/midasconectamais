<?php

namespace App\Filament\Admin\Resources\PropostaResource\Pages;

use App\Filament\Admin\Resources\PropostaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProposta extends CreateRecord
{
    protected static string $resource = PropostaResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.propostas.index');
    }
}
