<?php

namespace App\Filament\Midas\Resources;

use App\Filament\Midas\Resources\ClienteResource\Pages;
use App\Filament\Midas\Resources\ClienteResource\RelationManagers;
use App\Models\Cliente;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationGroup = 'Principal';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cpf')
                    ->required()
                    ->maxLength(50),
                Forms\Components\DatePicker::make('data_nascimento'),
                Forms\Components\TextInput::make('rg')
                    ->maxLength(50)
                    ->default('Não informado'),
                Forms\Components\TextInput::make('orgao_exp')
                    ->maxLength(50)
                    ->default('Não informado'),
                Forms\Components\DatePicker::make('data_exp'),
                Forms\Components\TextInput::make('naturalidade')
                    ->maxLength(100)
                    ->default('Não informado'),
                Forms\Components\TextInput::make('genitora')
                    ->maxLength(100)
                    ->default('Não informado'),
                Forms\Components\TextInput::make('genitor')
                    ->maxLength(100)
                    ->default('Não informado'),
                Forms\Components\TextInput::make('sexo')
                    ->maxLength(50)
                    ->default('Masculino'),
                Forms\Components\TextInput::make('estado_civil')
                    ->maxLength(50)
                    ->default('Casado'),
                Forms\Components\TextInput::make('phone1')
                    ->tel()
                    ->maxLength(50)
                    ->default('Casado'),
                Forms\Components\TextInput::make('phone2')
                    ->tel()
                    ->maxLength(50)
                    ->default('Casado'),
                Forms\Components\TextInput::make('phone3')
                    ->tel()
                    ->maxLength(50)
                    ->default('Casado'),
                Forms\Components\TextInput::make('phone4')
                    ->tel()
                    ->maxLength(50)
                    ->default('Casado'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_nascimento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rg')
                    ->searchable(),
                Tables\Columns\TextColumn::make('orgao_exp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_exp')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('naturalidade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('genitora')
                    ->searchable(),
                Tables\Columns\TextColumn::make('genitor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sexo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estado_civil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone4')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
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
            ])->modifyQueryUsing(fn(Builder $query): Builder => !auth()->user()->hasRole(Utils::getSuperAdminName())? $query->whereUserId(auth()->id()) : $query->whereNotNull('user_id'));
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
