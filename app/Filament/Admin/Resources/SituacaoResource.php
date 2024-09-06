<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\SituacaoResource\Pages;
use App\Filament\Resources\SituacaoResource\RelationManagers;
use App\Models\Situacao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SituacaoResource extends Resource
{
    protected static ?string $model = Situacao::class;

    protected static ?string $slug = 'situacoes';
    protected static ?string $modelLabel = 'Situação';
    protected static ?string $pluralModelLabel = 'Situações';
    protected static ?string $navigationLabel = 'Situação';
    protected static ?string $navigationGroup = 'Auxiliares';
    protected static ?string $navigationIcon = 'heroicon-s-exclamation-triangle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('descricao_situacao')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('motivo_situacao')
                        ->maxLength(100)
                        ->default('Não se aplica'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('descricao_situacao')
                    ->searchable(),
                Tables\Columns\TextColumn::make('motivo_situacao')
                    ->searchable(),
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
            'index' => \App\Filament\Admin\Resources\SituacaoResource\Pages\ListSituacoes::route('/'),
            'create' => \App\Filament\Admin\Resources\SituacaoResource\Pages\CreateSituacao::route('/create'),
            'edit' => \App\Filament\Admin\Resources\SituacaoResource\Pages\EditSituacao::route('/{record}/edit'),
        ];
    }
}
