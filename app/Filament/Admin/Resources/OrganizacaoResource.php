<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\OrganizacaoResource\Pages;
use App\Filament\Resources\OrganizacaoResource\RelationManagers;
use App\Models\Organizacao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrganizacaoResource extends Resource
{
    protected static ?string $slug = 'orgaos';

    protected static ?string $model = Organizacao::class;
    protected static ?string $pluralModelLabel = 'Orgãos';
    protected static ?string $navigationGroup = 'Auxiliares';
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome_organizacao')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_organizacao')
                    ->searchable(),
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
            'index' => \App\Filament\Admin\Resources\OrganizacaoResource\Pages\ListOrganizacaos::route('/'),
            'create' => \App\Filament\Admin\Resources\OrganizacaoResource\Pages\CreateOrganizacao::route('/create'),
            'edit' => \App\Filament\Admin\Resources\OrganizacaoResource\Pages\EditOrganizacao::route('/{record}/edit'),
        ];
    }
}
