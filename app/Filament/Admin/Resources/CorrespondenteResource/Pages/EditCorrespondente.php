<?php

namespace App\Filament\Admin\Resources\CorrespondenteResource\Pages;

use App\Filament\Admin\Resources\CorrespondenteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCorrespondente extends EditRecord
{
    protected static string $resource = CorrespondenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.correspondentes.index');
    }
}
