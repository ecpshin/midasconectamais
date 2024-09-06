<?php

namespace App\Filament\Midas\Resources;

use App\Filament\Midas\Resources\PropostaResource\Pages;
use App\Filament\Midas\Resources\PropostaResource\RelationManagers;
use App\Models\Proposta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropostaResource extends Resource
{
    protected static ?string $model = Proposta::class;

    protected static ?string $navigationGroup = 'Menu';

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
                Forms\Components\TextInput::make('tabela_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('percentual_loja')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('percentual_agente')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('percentual_corretor')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('valor_loja')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('valor_agente')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('valor_corretor')
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('cliente_id')
                    ->relationship('cliente', 'id')
                    ->required(),
                Forms\Components\Select::make('organizacao_id')
                    ->relationship('organizacao', 'id')
                    ->default(null),
                Forms\Components\Select::make('produto_id')
                    ->relationship('produto', 'id')
                    ->default(null),
                Forms\Components\Select::make('financeira_id')
                    ->relationship('financeira', 'id')
                    ->default(null),
                Forms\Components\Select::make('correspondente_id')
                    ->relationship('correspondente', 'id')
                    ->default(null),
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
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_contrato')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_digitacao')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_pagamento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('prazo_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parcela_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('liquido_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tabela_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentual_loja')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentual_agente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentual_corretor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valor_loja')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valor_agente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valor_corretor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cliente.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('organizacao.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('produto.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('financeira.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('correspondente.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('situacao.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
