<?php

namespace App\Filament\Admin\Resources\FinanceiraResource\Pages;

use App\Filament\Admin\Resources\FinanceiraResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFinanceiras extends ManageRecords
{
    protected static string $resource = FinanceiraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
