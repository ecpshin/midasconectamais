<?php

namespace App\Filament\Admin\Resources\TabelaResource\Pages;

use App\Filament\Admin\Resources\TabelaResource;
use App\Imports\TabelasImport;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;
use Maatwebsite\Excel\Facades\Excel;

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
            Actions\Action::make('import_tabelas')
                ->label('Importar Tabelas')
                ->color(Color::Amber)
                ->icon('heroicon-s-document-arrow-down')
                ->form([
                    FileUpload::make('attachment')
                ])->action(function (array $data){
                    Excel::import(new TabelasImport(), $data['attachment'], null,\Maatwebsite\Excel\Excel::XLS);

                    return Notification::make('import')->title('Tabelas importadas com sucesso!');
                })
        ];
    }
}
