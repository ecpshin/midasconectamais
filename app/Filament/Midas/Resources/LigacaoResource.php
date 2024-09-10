<?php

namespace App\Filament\Midas\Resources;

use App\Filament\Midas\Resources\LigacaoResource\Pages;
use App\Filament\Midas\Resources\LigacaoResource\RelationManagers;
use App\Models\Ligacao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LigacaoResource extends Resource
{
    protected static ?string $model = Ligacao::class;

    protected static ?string $slug = 'call-center-ligacoes';
    protected static ?string $navigationGroup = 'Call Center';


    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                    Forms\Components\Select::make('user_id')
                    Forms\Components\DatePicker::make('data_ligacao'),
                    Forms\Components\DatePicker::make('data_agendamento'),

                    Forms\Components\TextInput::make('nome')
                        ->maxLength(255)
                    Forms\Components\TextInput::make('cpf')
                        ->default(null),

                    Forms\Components\TextInput::make('matricula')
                    Forms\Components\TextInput::make('margem')
                        ->numeric()
                    Forms\Components\TextInput::make('telefone')
                        ->tel()
                        ->default('(84)9 0000-0000'),
                            ->maxLength(255)
                            ->default('Não informado'),
                        ->columnSpanFull(),
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status.status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('organizacao.nome_organizacao')
                    ->sortable(),
                Tables\Columns\TextColumn::make('produto.descricao_produto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_ligacao')
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_agendamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matricula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('margem')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('orgao')
                    ->searchable(),
                Tables\Columns\TextColumn::make('produto')
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

    public static function getPages(): array
    {
        return [
        ];
    }
}
