<?php

namespace App\Filament\Midas\Resources\LigacaoResource\Pages;

use App\Filament\Midas\Resources\LigacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLigacao extends EditRecord
{
    protected static string $resource = LigacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
