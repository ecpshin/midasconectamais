<?php

namespace App\Filament\Admin\Resources\ClienteResource\RelationManagers;

use App\Services\BuscasApiService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class InfoResidencialRelationManager extends RelationManager
{
    protected static string $relationship = 'infoResidencial';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cep')
                    ->mask('99999-999')
                    ->required()
                    ->maxLength(9)
                    ->suffixAction(fn($state, $set) => Forms\Components\Actions\Action::make('search-action')
                    ->icon('heroicon-o-magnifying-glass')
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
                Forms\Components\TextInput::make('logradouro')
                    ->maxLength(255),
                Forms\Components\TextInput::make('complemento')
                    ->maxLength(100),
                Forms\Components\TextInput::make('bairro')
                    ->maxLength(100),
                Forms\Components\TextInput::make('localidade')
                    ->maxLength(100),
                Forms\Components\TextInput::make('uf')
                    ->maxLength(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('cep')
            ->columns([
                Tables\Columns\TextColumn::make('cep')->searchable(),
                Tables\Columns\TextColumn::make('logradouro')->searchable(),
                Tables\Columns\TextColumn::make('complemento'),
                Tables\Columns\TextColumn::make('bairro')->searchable(),
                Tables\Columns\TextColumn::make('localidade')->searchable(),
                Tables\Columns\TextColumn::make('uf'),
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
