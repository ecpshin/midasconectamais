<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\EstadoCivilResource\Pages;
use App\Filament\Resources\EstadoCivilResource\RelationManagers;
use App\Models\EstadoCivil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EstadoCivilResource extends Resource
{
    protected static ?string $model = EstadoCivil::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Auxiliares';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('estado_civil')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('estado_civil')
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\EstadoCivilResource\Pages\ManageEstadoCivils::route('/'),
        ];
    }
}
