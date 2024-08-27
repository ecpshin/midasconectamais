<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComissaoResource\Pages;
use App\Filament\Resources\ComissaoResource\RelationManagers;
use App\Models\Comissao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComissaoResource extends Resource
{
    protected static ?string $model = Comissao::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListComissaos::route('/'),
            'create' => Pages\CreateComissao::route('/create'),
            'edit' => Pages\EditComissao::route('/{record}/edit'),
        ];
    }
}
