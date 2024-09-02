<?php

namespace App\Filament\Resources\ClienteResource\RelationManagers;

use App\Enums\TipoContaEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InfoBancariasRelationManager extends RelationManager
{
    protected static string $relationship = 'infoBancarias';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')
                    ->required()
                    ->maxLength(50),
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
