<?php

namespace App\Filament\Admin\Resources\StatusResource\Pages;

use App\Filament\Admin\Resources\StatusResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStatus extends CreateRecord
{
    protected static string $resource = StatusResource::class;

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.status.index');
    }
}
