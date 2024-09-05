<?php

namespace App\Filament\Resources\ClienteResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\TipoContaEnum;
use Filament\Actions\Action;
use App\Services\BuscasApiService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

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
                    ->suffixAction(fn($state, Set $set) => Action::make('search-action')
                ->icon('heroicon-o-magnify-glass')
                ->action(function () use ($state, $set) {
                    if(blank($state))
                    {
                        Notification::make()
                            ->title('Digite um CEP para buscar o endereço')
                            ->danger()
                            ->send();
                        return;
                    }

                    $dataCep = BuscasApiService::buscaCep($state);

                    $set('logradouro', $dataCep['street']);
                    $set('bairro', $dataCep['neighborhood']);
                    $set('localidade', $dataCep['city']);
                    $set('uf', $dataCep['state']);
                })),
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
