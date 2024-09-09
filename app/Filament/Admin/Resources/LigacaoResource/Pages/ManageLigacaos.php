<?php

namespace App\Filament\Resources\LigacaoResource\Pages;

use App\Filament\Resources\LigacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLigacaos extends ManageRecords
{
    protected static string $resource = LigacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
