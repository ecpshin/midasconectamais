<?php

namespace App\Filament\Admin\Resources\CorrespondenteResource\Pages;

use App\Filament\Admin\Resources\CorrespondenteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCorrespondente extends CreateRecord
{
    protected static string $resource = CorrespondenteResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.correspondentes.index');
    }
}
