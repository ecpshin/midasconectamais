<?php

namespace App\Filament\Midas\Resources\ComissaoResource\Pages;

use App\Filament\Midas\Resources\ComissaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComissao extends EditRecord
{
    protected static string $resource = ComissaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
