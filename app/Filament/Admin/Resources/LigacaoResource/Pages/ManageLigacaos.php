<?php

namespace App\Filament\Admin\Resources\LigacaoResource\Pages;

use App\Filament\Admin\Resources\LigacaoResource;
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
