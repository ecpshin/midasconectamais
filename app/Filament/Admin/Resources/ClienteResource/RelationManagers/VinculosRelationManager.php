<?php

namespace App\Filament\Admin\Resources\ClienteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VinculosRelationManager extends RelationManager
{
    protected static string $relationship = 'vinculos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações Funcionais')
                    ->schema([
                        Forms\Components\Select::make('organizacao_id')
                            ->relationship('organizacao', 'nome_organizacao')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('nrbeneficio')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('senha')
                            ->label('Senha de acesso')
                            ->default('cliente@email.com'),
                ])->columns(['xl' => 4]),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nrbeneficio')
            ->columns([
                Tables\Columns\TextColumn::make('organizacao.nome_organizacao'),
                Tables\Columns\TextColumn::make('nrbeneficio'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('senha'),
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
