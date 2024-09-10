<?php

namespace App\Filament\Admin\Resources\ClienteResource\Pages;

use App\Filament\Admin\Resources\ClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCliente extends EditRecord
{
    protected static string $resource = ClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.clientes.index');
    }
}
