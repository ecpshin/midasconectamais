<?php

namespace App\Filament\Midas\Resources\ComissaoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ramsey\Uuid\Uuid;

class PropostaRelationManager extends RelationManager
{
    protected static string $relationship = 'proposta';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->maxLength(50)
                    ->default(substr(Uuid::uuid4(), 0, 13)),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('uuid')
            ->columns([
                Tables\Columns\TextColumn::make('uuid'),
                Tables\Columns\TextColumn::make('numero_contrato'),
                Tables\Columns\TextColumn::make('data_digitacao')
                    ->date('d/m/y'),
                Tables\Columns\TextColumn::make('data_finalizacao')
                    ->date('d/m/y'),
                Tables\Columns\TextColumn::make('cliente.nome'),
                Tables\Columns\TextColumn::make('prazo'),
                Tables\Columns\TextColumn::make('total_proposta'),
                Tables\Columns\TextColumn::make('liquido_proposta'),
                Tables\Columns\TextColumn::make('parcela_proposta'),
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
