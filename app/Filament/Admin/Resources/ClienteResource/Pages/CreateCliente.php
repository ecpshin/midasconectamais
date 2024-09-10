<?php

namespace App\Filament\Admin\Resources\ClienteResource\Pages;

use App\Filament\Admin\Resources\ClienteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.clientes.index');
    }

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user()->can('create cliente');
    }
}
