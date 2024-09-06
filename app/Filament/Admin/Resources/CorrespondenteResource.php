<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\CorrespondenteResource\Pages;
use App\Filament\Resources\CorrespondenteResource\RelationManagers;
use App\Models\Correspondente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CorrespondenteResource extends Resource
{
    protected static ?string $model = Correspondente::class;

    protected static ?string $navigationGroup = 'Essenciais';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('nome_correspondente')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('nome_responsavel')
                        ->maxLength(50)
                        ->default(null),
                    Forms\Components\TextInput::make('phone_contato')
                        ->tel()
                        ->maxLength(50)
                        ->default(null),
                    Forms\Components\TextInput::make('cpf_cnpj')
                        ->maxLength(50)
                        ->default(null),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_correspondente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nome_responsavel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_contato')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf_cnpj')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => \App\Filament\Admin\Resources\CorrespondenteResource\Pages\ListCorrespondentes::route('/'),
            'create' => \App\Filament\Admin\Resources\CorrespondenteResource\Pages\CreateCorrespondente::route('/create'),
            'edit' => \App\Filament\Admin\Resources\CorrespondenteResource\Pages\EditCorrespondente::route('/{record}/edit'),
        ];
    }


}
