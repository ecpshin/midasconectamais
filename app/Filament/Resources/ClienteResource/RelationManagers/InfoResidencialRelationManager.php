<?php

namespace App\Filament\Resources\ClienteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->maxLength(9),
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
