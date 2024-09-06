<?php

namespace App\Filament\Admin\Resources\ClienteResource\RelationManagers;

use App\Enums\TipoContaEnum;
use App\Services\BuscasApiService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class InfoBancariasRelationManager extends RelationManager
{
    protected static string $relationship = 'infoBancarias';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(50)
                    ->suffixAction(
                        fn($state, $set) => Forms\Components\Actions\Action::make('search-action')
                            ->icon('heroicon-o-magnifying-glass')
                            ->action(
                                function () use ($state, $set) {
                                    if(blank($state)){
                                        Notification::make()
                                            ->title('Digite o código para buscar o banco')
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    $dataBank = BuscasApiService::buscaBanco($state);

                                    if(key_exists('message', $dataBank))
                                    {
                                        Notification::make()->title($dataBank['message'])
                                            ->danger()
                                            ->send();
                                    } else {
                                        $set('banco', strtoupper($dataBank['fullName']));
                                    }
                                }
                            )
                    ),
                Forms\Components\TextInput::make('banco')
                    ->maxLength(255),
                Forms\Components\TextInput::make('agencia'),
                Forms\Components\TextInput::make('conta')
                    ->maxLength(50),
                Forms\Components\Select::make('tipo')
                    ->options(TipoContaEnum::class)
                    ->default('Conta Corrente'),
                Forms\Components\Select::make('operacao')
                    ->options([
                        'Crédito em Conta' => 'Credito em Conta',
                        'Débito em Conta' => 'Débito em Conta',
                        'Ordem de Pagamento' => 'Ordem de Pagamento',
                        'PIX' => 'PIX',
                        'TED' => 'TED',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('codigo')
            ->columns([
                Tables\Columns\TextColumn::make('codigo'),
                Tables\Columns\TextColumn::make('banco'),
                Tables\Columns\TextColumn::make('agencia'),
                Tables\Columns\TextColumn::make('conta'),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('operacao'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
