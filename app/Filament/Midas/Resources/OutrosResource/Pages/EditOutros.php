<?php

namespace App\Filament\Midas\Resources\OutrosResource\Pages;

use App\Filament\Midas\Resources\OutrosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOutros extends EditRecord
{
    protected static string $resource = OutrosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
