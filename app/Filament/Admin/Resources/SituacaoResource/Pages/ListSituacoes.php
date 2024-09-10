<?php

namespace App\Filament\Admin\Resources\SituacaoResource\Pages;

use App\Filament\Admin\Resources\SituacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSituacoes extends ListRecords
{
    protected static string $resource = SituacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
