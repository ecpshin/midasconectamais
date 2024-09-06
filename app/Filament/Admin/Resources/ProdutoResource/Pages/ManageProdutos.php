<?php

namespace App\Filament\Admin\Resources\ProdutoResource\Pages;

use App\Filament\Admin\Resources\ProdutoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProdutos extends ManageRecords
{
    protected static string $resource = ProdutoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
