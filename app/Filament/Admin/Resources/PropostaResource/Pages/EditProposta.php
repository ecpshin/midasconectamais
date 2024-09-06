<?php

namespace App\Filament\Admin\Resources\PropostaResource\Pages;

use App\Filament\Admin\Resources\PropostaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProposta extends EditRecord
{
    protected static string $resource = PropostaResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.propostas.index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
