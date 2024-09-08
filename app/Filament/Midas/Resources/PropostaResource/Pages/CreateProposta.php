<?php

namespace App\Filament\Midas\Resources\PropostaResource\Pages;

use App\Filament\Midas\Resources\PropostaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProposta extends CreateRecord
{

    protected static string $resource = PropostaResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.midas.resources.propostas.index');
    }

}
