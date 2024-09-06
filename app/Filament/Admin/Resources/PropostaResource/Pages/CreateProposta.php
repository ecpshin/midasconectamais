<?php

namespace App\Filament\Resources\PropostaResource\Pages;

use App\Filament\Resources\PropostaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProposta extends CreateRecord
{
    protected static string $resource = PropostaResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.propostas.index');
    }
}
