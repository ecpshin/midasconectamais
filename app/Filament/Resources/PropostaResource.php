<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropostaResource\Pages;
use App\Filament\Resources\PropostaResource\RelationManagers;
use App\Models\Proposta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropostaResource extends Resource
{
    protected static ?string $model = Proposta::class;

    protected static ?string $navigationGroup = "Principal";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->maxLength(50)
                    ->default('1e85e666-6894-4c83-9d64-0570a61b0991'),
                Forms\Components\TextInput::make('numero_contrato')
                    ->maxLength(50)
                    ->default('Não informado'),
                Forms\Components\DatePicker::make('data_digitacao'),
                Forms\Components\DatePicker::make('data_pagamento'),
                Forms\Components\TextInput::make('total_proposta')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('prazo_proposta')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('parcela_proposta')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('liquido_proposta')
                    ->numeric()
                    ->default(null),
                Forms\Components\Select::make('cliente_id')
                    ->relationship('cliente', 'id')
                    ->required(),
                Forms\Components\Select::make('produto_id')
                    ->relationship('produto', 'id')
                    ->required(),
                Forms\Components\Select::make('financeira_id')
                    ->relationship('financeira', 'id')
                    ->required(),
                Forms\Components\Select::make('correspondente_id')
                    ->relationship('correspondente', 'id')
                    ->required(),
                Forms\Components\Select::make('situacao_id')
                    ->relationship('situacao', 'id')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cliente.nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cliente.cpf')->label('CPF')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numero_contrato')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_digitacao')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_pagamento')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('prazo_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_proposta')
                    ->numeric()
                    ->money('BRL')
                    ->summarize([
                        Average::make(),
                        Sum::make()
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('parcela_proposta')
                    ->numeric()
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('liquido_proposta')
                    ->numeric()
                    ->money('BRL')
                    ->summarize([
                        Average::make(),
                        Sum::make()
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('produto.descricao_produto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('financeira.nome_financeira')
                    ->sortable(),
                Tables\Columns\TextColumn::make('correspondente.nome_correspondente')
                    ->label('Correspondente')
                    ->sortable(),
                Tables\Columns\TextColumn::make('situacao.descricao_situacao')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPropostas::route('/'),
            'create' => Pages\CreateProposta::route('/create'),
            'edit' => Pages\EditProposta::route('/{record}/edit'),
        ];
    }
}
