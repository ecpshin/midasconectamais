<?php

namespace App\Filament\Resources\SituacaoResource\Pages;

use App\Filament\Resources\SituacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSituacaos extends ListRecords
{
    protected static string $resource = SituacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
