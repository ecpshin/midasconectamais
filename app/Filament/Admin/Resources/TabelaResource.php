<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\TabelaResource\Pages;
use App\Filament\Resources\TabelaResource\RelationManagers;
use App\Models\Tabela;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TabelaResource extends Resource
{
    protected static ?string $model = Tabela::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Midas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make([
                    Forms\Components\Fieldset::make()->schema([

                        Forms\Components\Group::make([

                            Forms\Components\Select::make('produto_id')
                                ->relationship('produto', 'descricao_produto')
                                ->searchable()
                                ->preload(),

                            Forms\Components\Select::make('financeira_id')
                                ->relationship('financeira', 'nome_financeira')
                                ->searchable()
                                ->preload(),

                            Forms\Components\Select::make('correspondente_id')
                                ->relationship('correspondente', 'nome_correspondente')
                                ->searchable()
                                ->preload(),

                            Forms\Components\Select::make('organizacao_id')
                                ->relationship('organizacao', 'nome_organizacao')
                                ->searchable()
                                ->preload()

                        ])->columns(['lg' => 4])->columnSpan(['lg' => 'full']),

                    ]),

                    Forms\Components\Fieldset::make()->schema([

                        Forms\Components\Group::make([

                            Forms\Components\TextInput::make('descricao')
                                ->maxLength(100)
                                ->default(null),

                            Forms\Components\TextInput::make('codigo')
                                ->maxLength(100)
                                ->default(null),

                        ])->columns(['lg' => 2])->columnSpan(['lg' => 'full']),
                    ]),

                    Forms\Components\Fieldset::make()->schema([

                        Forms\Components\Group::make([


                            Forms\Components\Group::make([

                                Forms\Components\TextInput::make('percentual_diferido')
                                    ->label('Diferido %')
                                    ->numeric()
                                    ->step(0.01)
                                    ->minValue(0.00)
                                    ->maxValue(100.00)
                                    ->suffix('%')
                                    ->default('0,00'),

                                Forms\Components\TextInput::make('prazo')
                                    ->maxLength(50)
                                    ->default(null),

                                Forms\Components\Select::make('referencia')
                                    ->label('Referência')
                                    ->options([
                                        'B' => 'Bruto',
                                        'BL' => 'Bruto|Liquido',
                                        'L' => 'Líquido',
                                    ]),

                                Forms\Components\Toggle::make('parcelado')
                                    ->label('Comissão Parcelada')
                                    ->inlineLabel(false)
                                    ->default(false),
                            ]),

                            Forms\Components\Group::make([
                                Forms\Components\TextInput::make('percentual_loja')
                                    ->numeric()
                                    ->step(0.01)
                                    ->minValue(0.00)
                                    ->maxValue(100.00)
                                    ->suffix('%')
                                    ->default('0,00'),

                                Forms\Components\TextInput::make('percentual_agente')
                                    ->numeric()
                                    ->step(0.01)
                                    ->minValue(0.00)
                                    ->maxValue(100.00)
                                    ->suffix('%')
                                    ->default('0,00'),
                                Forms\Components\TextInput::make('percentual_corretor')
                                    ->numeric()
                                    ->step(0.01)
                                    ->minValue(0.00)
                                    ->maxValue(100.00)
                                    ->suffix('%')
                                    ->default('0,00'),

                            ]),

                            Forms\Components\Group::make([

                                Forms\Components\TextInput::make('bonus')
                                    ->numeric()->step(0.01)
                                    ->minValue(0.00)
                                    ->maxValue(100.00)
                                    ->suffix('%')
                                    ->default('0,00'),

                            ])


                        ])->columns(['lg' => 4])->columnSpan(['lg' => 'full']),

                    ]),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('produto.descricao_produto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('financeira.nome_financeira')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('correspondente.nome_correspondente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('organizacao.nome_organizacao')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descricao')
                    ->searchable(),
                Tables\Columns\TextColumn::make('codigo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prazo')
                    ->searchable(),
                Tables\Columns\IconColumn::make('parcelado')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('referencia')
                    ->searchable(),
                Tables\Columns\TextColumn::make('percentual_loja')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bonus')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentual_diferido')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentual_agente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentual_corretor')
                    ->numeric()
                    ->sortable(),
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
                Tables\Columns\TextColumn::make('descricao_codigo')
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
            'index' => \App\Filament\Admin\Resources\TabelaResource\Pages\ListTabelas::route('/'),
            'create' => \App\Filament\Admin\Resources\TabelaResource\Pages\CreateTabela::route('/create'),
            'edit' => \App\Filament\Admin\Resources\TabelaResource\Pages\EditTabela::route('/{record}/edit'),
        ];
    }
}
