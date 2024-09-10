<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\PropostaResource\Pages;
use App\Filament\Resources\PropostaResource\RelationManagers;
use App\Models\Proposta;
use App\Models\Tabela;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PropostaResource extends Resource
{
    protected static ?string $model = Proposta::class;
    protected static ?string $navigationGroup = "Principal";
    protected static ?string $navigationIcon = 'heroicon-s-document-currency-dollar';


    public static function form(Form $form): Form
    {
        return $form
            ->live()
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
                            ->relationship('user', 'name')
                            ->required(),

                        Forms\Components\Group::make([

                            Forms\Components\TextInput::make('uuid')
                                ->label('UUID')
                                ->maxLength(50)
                                ->default('1e85e666-6894-4c83-9d64-0570a61b0991'),

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
                                ->relationship('produto', 'descricao_produto')
                                ->live()
                                ->searchable()
                                ->preload()
                                ->required(),

                            Forms\Components\Select::make('financeira_id')
                                ->relationship('financeira', 'nome_financeira')
                                ->live()
                                ->searchable()
                                ->preload()
                                ->required(),

                            Forms\Components\Select::make('correspondente_id')
                                ->relationship('correspondente', 'nome_correspondente')
                                ->live()
                                ->searchable()
                                ->preload()
                                ->required(),

                        ])->columns(['lg' => 4])->columnSpanFull(),

                        Forms\Components\Group::make([
                            Forms\Components\Select::make('tabela_id')
                                ->label('Tabela')
                                ->options(function ($state, Forms\Get $get) {
                                    if (empty($get('organizacao_id')) || empty($get('produto_id')) || empty($get('financeira_id'))
                                        || empty($get('correspondente_id'))) {
                                        return Tabela::all()->pluck('descricao_codigo', 'id');
                                    } else {
                                        return Tabela::where('produto_id', $get('produto_id'))
                                            ->where('financeira_id', $get('financeira_id'))
                                            ->where('correspondente_id', $get('correspondente_id'))
                                            ->pluck('descricao_codigo', 'id');

                                    }
                                } // end function
                                )->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set): void {
                                    if (!is_null($state)) {
                                        $tabela = Tabela::query()->where('id', $state)->first()->toArray();

                                        //vem da Tabela::class
                                        $referencia = $tabela['referencia'];
                                        $p_loja = doubleval($tabela['percentual_loja']);
                                        $p_agente = doubleval($tabela['percentual_agente']);
                                        $p_corretor = doubleval($tabela['percentual_corretor']);

                                        //vem do Form
                                        $total_proposta = doubleval($get('total_proposta'));

                                        $liquido_proposta = doubleval($get('liquido_proposta'));

                                        $v_loja = 0.0;
                                        $v_agente = 0.0;
                                        $v_corretor = 0.0;


                                        if ($referencia === 'L') {
                                            $v_loja = $total_proposta * ($p_loja / 100);
                                            $v_agente = $liquido_proposta * ($p_agente / 100);
                                            $v_corretor = $liquido_proposta * ($p_corretor / 100);
                                        } elseif ($referencia === 'B' || $referencia === 'BL') {
                                            $v_loja = $total_proposta * ($p_loja / 100);
                                            $v_agente = $liquido_proposta * ($p_agente / 100);
                                            $v_corretor = $liquido_proposta * ($p_corretor / 100);
                                        }

                                        $set('percentual_loja', $p_loja);
                                        $set('percentual_agente', $p_agente);
                                        $set('percentual_corretor', $p_corretor);
                                        $set('valor_loja', round($v_loja), false);
                                        $set('valor_agente', round($v_agente), false);
                                        $set('valor_corretor', round($v_corretor), false);
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
        $is_super = auth()->user()->hasRole(Utils::getSuperAdminName());

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cliente.nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cliente.cpf')->label('CPF')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numero_contrato')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_digitacao')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_pagamento')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('prazo_proposta')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_proposta')
                    ->numeric()
                    ->money('BRL')
                    ->summarize([
                        Average::make()->money('BRL', divideBy: 100),
                        Sum::make()->money('BRL', divideBy: 100)
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('parcela_proposta')
                    ->numeric()
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\TextColumn::make('liquido_proposta')
                    ->numeric()
                    ->money('BRL')
                    ->summarize([
                        Average::make()->money('BRL', divideBy: 100),
                        Sum::make()->money('BRL', divideBy: 100)
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('produto.descricao_produto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('financeira.nome_financeira')
                    ->sortable(),
                Tables\Columns\TextColumn::make('correspondente.nome_correspondente')
                    ->label('Correspondente')
                    ->sortable(),
                Tables\Columns\TextColumn::make('situacao.descricao_situacao')

            ])->modifyQueryUsing(fn(Builder $query): Builder => ($is_super) ? $query->whereNotNull('user_id', 'and') : $query->whereUserId(auth()->id()))
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
            'index' => \App\Filament\Admin\Resources\PropostaResource\Pages\ListPropostas::route('/'),
            'create' => \App\Filament\Admin\Resources\PropostaResource\Pages\CreateProposta::route('/create'),
            'edit' => \App\Filament\Admin\Resources\PropostaResource\Pages\EditProposta::route('/{record}/edit'),
        ];
    }
}
