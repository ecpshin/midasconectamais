<?php

namespace App\Filament\Admin\Resources\SituacaoResource\Pages;

use App\Filament\Admin\Resources\SituacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSituacao extends EditRecord
{
    protected static string $resource = SituacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.situacoes.index');
    }
}
