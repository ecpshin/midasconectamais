<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\ComissaoResource\Pages;
use App\Filament\Resources\ComissaoResource\RelationManagers;
use App\Models\Comissao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ComissaoResource extends Resource
{
    protected static ?string $model = Comissao::class;

    protected static ?string $modelLabel = 'Comissão';
    protected static ?string $navigationLabel = 'Comissões';

    protected static ?string $slug = 'comissoes-agente';

    protected static ?string $navigationGroup = 'Midas';

    protected static ?string $navigationIcon = 'heroicon-s-document-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Split::make([
                    Forms\Components\Section::make([
                        Forms\Components\Select::make('proposta_id')
                            ->label('Proposta')
                            ->relationship('proposta', 'uuid')
                            ->disabledOn('edit'),

                        Forms\Components\Select::make('tabela_id')
                            ->label('Tabela')
                            ->relationship('tabela', 'descricao')
                            ->disabledOn('edit'),

                    ]),
                    Forms\Components\Section::make([
                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('percentual_loja')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(100.00),
                            Forms\Components\TextInput::make('valor_loja')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(1000000.00),
                        ])->columns(['lg' => 2]),
                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('percentual_agente')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(100.00),
                            Forms\Components\TextInput::make('valor_agente')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(1000000.00),
                        ])->columns(['lg' => 2]),
                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('percentual_corretor')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(100.00),
                            Forms\Components\TextInput::make('valor_corretor')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(1000000.00),
                        ])->columns(['lg' => 2]),
                    ])
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposta.uuid')->label('Uuid'),
                Tables\Columns\TextColumn::make('proposta.numero_contrato'),
                Tables\Columns\TextColumn::make('proposta.cliente.nome'),
                Tables\Columns\TextColumn::make('tabela.descricao'),
                Tables\Columns\TextColumn::make('proposta.total_proposta')
                    ->money('BRL'),
                Tables\Columns\TextColumn::make('data_repasse'),
                Tables\Columns\TextColumn::make('valor_agente')
                    ->money('BRL'),
                Tables\Columns\TextColumn::make('valor_corretor')
                    ->money('BRL'),
                Tables\Columns\TextColumn::make('valor_loja')
                    ->money('BRL'),
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
            \App\Filament\Admin\Resources\ComissaoResource\RelationManagers\PropostaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\ComissaoResource\Pages\ListComissaos::route('/'),
            'create' => \App\Filament\Admin\Resources\ComissaoResource\Pages\CreateComissao::route('/create'),
            'edit' => \App\Filament\Admin\Resources\ComissaoResource\Pages\EditComissao::route('/{record}/edit'),
        ];
    }
}
