<?php

namespace App\Filament\Admin\Resources\OutrosResource\Pages;

use App\Filament\Admin\Resources\OutrosResource;
use Filament\Resources\Pages\ListRecords;

class ListOutros extends ListRecords
{
    protected static string $resource = OutrosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
