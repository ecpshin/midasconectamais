<?php

namespace App\Filament\Admin\Resources\EstadoCivilResource\Pages;

use App\Filament\Admin\Resources\EstadoCivilResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEstadoCivils extends ManageRecords
{
    protected static string $resource = EstadoCivilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
