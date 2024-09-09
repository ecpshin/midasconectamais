<?php

namespace App\Filament\Resources\TabelaResource\Pages;

use App\Filament\Resources\TabelaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTabela extends EditRecord
{
    protected static string $resource = TabelaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
