<?php

namespace App\Filament\Admin\Resources\ComissaoResource\Pages;

use App\Filament\Admin\Resources\ComissaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComissao extends EditRecord
{
    protected static string $resource = ComissaoResource::class;

    protected function getRedirectUrl(): ?string
    {
        return route('filament.admin.resources.comissoes-agente.index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
