<?php

namespace App\Filament\Midas\Resources;

use App\Filament\Midas\Resources\PropostaResource\Pages;
use App\Filament\Midas\Resources\PropostaResource\RelationManagers;
use App\Models\Proposta;
use App\Models\Tabela;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PropostaResource extends Resource
{
    protected static ?string $model = Proposta::class;

    protected static ?string $navigationGroup = 'Menu';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $is_super = auth()->user()->hasRole(Utils::getSuperAdminName());

        return $form
            ->schema([
                Forms\Components\Section::make([

                    Forms\Components\Fieldset::make()->schema([

                        Forms\Components\Select::make('cliente_id')
                            ->relationship('cliente', 'nome')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('user_id')
                            ->label('Digitado por')
                            ->relationship('user', 'name',
                                fn(Builder $query): Builder => $is_super ? $query->whereNotNull('id') : $query->where('id', auth()->id()))
                            ->required(),

                        Forms\Components\Group::make([

                            Forms\Components\TextInput::make('uuid')
                                ->label('UUID')
                                ->maxLength(50)
                                ->default(substr(\Ramsey\Uuid\Uuid::uuid4()->toString(), 0, 13)),

                            Forms\Components\TextInput::make('numero_contrato')
                                ->maxLength(50)
                                ->default('Não informado'),

                            Forms\Components\DatePicker::make('data_digitacao')
                                ->maxDate(now()->addYears(5)),

                            Forms\Components\DatePicker::make('data_pagamento')
                                ->maxDate(now()->addYears(5)),

                        ])->columns(['lg' => '4'])->columnSpan(['lg' => 'full']),
                    ]),

                    Forms\Components\Fieldset::make('Dados Financeiros')->schema([

                        Forms\Components\Group::make([

                            Forms\Components\TextInput::make('prazo_proposta')
                                ->numeric()
                                ->step(1)
                                ->minValue(0)
                                ->maxValue(300)
                                ->default('0')
                                ->live(),

                            Forms\Components\TextInput::make('total_proposta')
                                ->numeric()
                                ->live()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(1000000.00)
                                ->default('0'),

                            Forms\Components\TextInput::make('parcela_proposta')
                                ->numeric()
                                ->live()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(1000000.00)
                                ->default('0'),

                            Forms\Components\TextInput::make('liquido_proposta')
                                ->numeric()
                                ->live()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(1000000.00)
                                ->default('0'),

                            Forms\Components\Select::make('situacao_id')
                                ->relationship('situacao', 'descricao_situacao')
                                ->required()
                                ->default(5),

                        ])->columns(['xl' => '5'])->columnSpan(['lg' => 'full']),

                        Forms\Components\Group::make([

                            Forms\Components\Select::make('organizacao_id')
                                ->relationship('organizacao', 'nome_organizacao')
                                ->live()
                                ->searchable()
                                ->preload()
                                ->afterStateUpdated(function ($state, Forms\Set $set): void {
                                    if (is_null($state)) {
                                        $set('produto_id', null);
                                        $set('financeira_id', null);
                                        $set('correspondente_id', null);
                                        $set('tabela_id', null);
                                    }
                                })
                                ->required(),

                            Forms\Components\Select::make('produto_id')
                                ->options(function (Forms\Get $get) {
                                    if (!is_null($get('organizacao_id'))) {
                                        return Tabela::with('produto')->where('organizacao_id', $get('organizacao_id'))->get()->pluck('produto.descricao_produto', 'produto.id');
                                    }
                                })
                                ->live()
                                ->searchable()
                                ->preload()
                                ->required(),

                            Forms\Components\Select::make('financeira_id')
                                ->options(function (Forms\Get $get) {
                                    if (!is_null($get('produto_id'))) {
                                        return Tabela::with('financeira')
                                            ->where('produto_id', $get('produto_id'))
                                            ->get()
                                            ->pluck('financeira.nome_financeira', 'financeira.id');
                                    }
                                })
                                ->live()
                                ->searchable()
                                ->preload()
                                ->required(),

                            Forms\Components\Select::make('correspondente_id')
                                ->options(function (Forms\Get $get) {
                                    if (!is_null($get('financeira_id'))) {
                                        return Tabela::with('correspondente')
                                            ->where('financeira_id', $get('financeira_id'))
                                            ->get()
                                            ->pluck('correspondente.nome_correspondente', 'correspondente.id');
                                    }
                                })
                                ->live()
                                ->searchable()
                                ->preload()
                                ->required(),

                        ])->columns(['lg' => 4])->columnSpanFull(),

                        Forms\Components\Group::make([
                            Forms\Components\Select::make('tabela_id')
                                ->label('Tabela')
                                ->live()
                                ->options(function (Forms\Get $get) {
                                    if (is_null($get('organizacao_id')) || is_null($get('produto_id')) || is_null($get('financeira_id'))
                                        || is_null($get('correspondente_id'))) {
                                        return Tabela::all()->pluck('descricao_codigo', 'id');
                                    } else {
                                        return Tabela::where('produto_id', $get('produto_id'))
                                            ->where('financeira_id', $get('financeira_id'))
                                            ->where('correspondente_id', $get('correspondente_id'))
                                            ->pluck('descricao_codigo', 'id');
                                    }
                                })->afterStateUpdated(function (Forms\Get $get, Forms\Set $set) {
                                    if (!is_null($get('tabela_id'))) {
                                        $tabela = Tabela::query()->where('id', $get('tabela_id'))->first()->toArray();

                                        //vem da Tabela::class
                                        $referencia = $tabela['referencia'];
                                        $percentual_loja = floatval($tabela['percentual_loja']);
                                        $percentual_agente = floatval($tabela['percentual_agente']);
                                        $percentual_corretor = floatval($tabela['percentual_corretor']);

                                        //vem do Form
                                        $total_proposta = floatval($get('total_proposta'));

                                        $liquido_proposta = floatval($get('liquido_proposta'));

                                        $valor_loja = 0.0;
                                        $valor_agente = 0.0;
                                        $valor_corretor = 0.0;


                                        if ($referencia === 'L') {
                                            $valor_loja = $total_proposta * ($percentual_loja / 100);
                                            $valor_agente = $liquido_proposta * ($percentual_agente / 100);
                                            $valor_corretor = $liquido_proposta * ($percentual_corretor / 100);
                                        } elseif ($referencia === 'B' || $referencia === 'BL') {
                                            $valor_loja = $total_proposta * ($percentual_loja / 100);
                                            $valor_agente = $liquido_proposta * ($percentual_agente / 100);
                                            $valor_corretor = $liquido_proposta * ($percentual_corretor / 100);
                                        }

                                        $set('percentual_loja', $percentual_loja);
                                        $set('percentual_agente', $percentual_agente);
                                        $set('percentual_corretor', $percentual_corretor);

                                        $set('valor_loja', $valor_loja, false);
                                        $set('valor_agente', $valor_agente, false);
                                        $set('valor_corretor', $valor_corretor, false);
                                    }
                                })

                        ])->columnSpanFull(),

                        Forms\Components\Group::make([

                            Forms\Components\TextInput::make('percentual_loja')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(100.00)
                                ->default('0'),

                            Forms\Components\TextInput::make('valor_loja')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(1000000.00)
                                ->default('0'),
                        ]),

                        Forms\Components\Group::make([

                            Forms\Components\TextInput::make('percentual_agente')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(100.00)
                                ->default('0'),

                            Forms\Components\TextInput::make('valor_agente')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(10000000.00)
                                ->default('0'),
                        ]),

                        Forms\Components\Group::make([

                            Forms\Components\TextInput::make('percentual_corretor')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0)
                                ->maxValue(100.00)
                                ->default('0'),

                            Forms\Components\TextInput::make('valor_corretor')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0)
                                ->maxValue(10000000.00)
                                ->default('0'),
                        ]),

                    ])->columns(['lg' => 3]),
                ]),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_contrato')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_digitacao')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_pagamento')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('prazo_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parcela_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('liquido_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tabela_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentual_loja')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentual_agente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('percentual_corretor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valor_loja')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valor_agente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valor_corretor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cliente.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('organizacao.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('produto.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('financeira.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('correspondente.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('situacao.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
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
            'index' => Pages\ListPropostas::route('/'),
            'create' => Pages\CreateProposta::route('/create'),
            'edit' => Pages\EditProposta::route('/{record}/edit'),
        ];
    }
}
