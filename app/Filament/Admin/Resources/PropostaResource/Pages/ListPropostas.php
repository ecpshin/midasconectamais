<?php

namespace App\Filament\Resources\PropostaResource\Pages;

use App\Filament\Resources\PropostaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPropostas extends ListRecords
{
    protected static string $resource = PropostaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
