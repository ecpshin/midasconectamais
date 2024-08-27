<?php

namespace App\Filament\Midas\Resources;

use App\Filament\Midas\Resources\ComissaoResource\Pages;
use App\Filament\Midas\Resources\ComissaoResource\RelationManagers;
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


    protected static ?string $navigationParentItem = 'Propostas';

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
                Tables\Columns\TextColumn::make('proposta.user.name')->label('Usuário'),
                Tables\Columns\TextColumn::make('proposta.total_proposta')->label('Total'),
                Tables\Columns\TextColumn::make('proposta.liquido_proposta')->label('Líquido'),
                Tables\Columns\TextColumn::make('tabela.descricao'),
                Tables\Columns\TextColumn::make('valor_agente')->label('Valor agente')->visible(auth()->user()->hasRole(config('filament-shield.midas_user.name'))),
                Tables\Columns\TextColumn::make('valor_corretor')->label('Valor corretor'),
                Tables\Columns\TextColumn::make('valor_loja')->visible(auth()->user()->hasRole(config('filament-shield.super_admin.name'))),
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
