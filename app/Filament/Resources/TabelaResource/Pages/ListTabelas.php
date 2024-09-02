<?php

namespace App\Filament\Resources\TabelaResource\Pages;

use App\Filament\Resources\TabelaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTabelas extends ListRecords
{
    protected static string $resource = TabelaResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.tabela.index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(fn() => auth()->user()->can('create_tabela')),
        ];
    }
}
