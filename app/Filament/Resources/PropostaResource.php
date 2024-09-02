<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropostaResource\Pages;
use App\Filament\Resources\PropostaResource\RelationManagers;
use App\Models\Organizacao;
use App\Models\Produto;
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
use Illuminate\Support\Collection;

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
                Forms\Components\Section::make()->schema([

                    Forms\Components\Select::make('cliente_id')
                        ->relationship('cliente', 'nome')
                        ->searchable()
                        ->preload()
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

                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('prazo_proposta')
                            ->numeric()
                            ->step(1)
                            ->minValue(0)
                            ->maxValue(300)
                            ->default('0'),
                        Forms\Components\TextInput::make('total_proposta')
                            ->numeric()
                            ->step(0.01)
                            ->minValue(0.00)
                            ->maxValue(10000000.00)
                            ->default('0,00'),
                        Forms\Components\TextInput::make('parcela_proposta')
                            ->numeric()
                            ->step(0.01)
                            ->minValue(0.00)
                            ->maxValue(10000000.00)
                            ->default('0,00'),
                        Forms\Components\TextInput::make('liquido_proposta')
                            ->numeric()
                            ->step(0.01)
                            ->minValue(0.00)
                            ->maxValue(10000000.00)
                            ->default('0,00'),
                        Forms\Components\Select::make('situacao_id')
                            ->relationship('situacao', 'descricao_situacao')
                            ->required(),
                    ])->columns(['xl' => '5'])->columnSpan(['lg' => 'full']),

                ]),
                Forms\Components\Section::make()->schema([

                    Forms\Components\Group::make([

                        Forms\Components\Select::make('organizacao_id')
                            ->options(Organizacao::pluck('nome_organizacao', 'id'))
                            ->live()
                            ->required(),

                        Forms\Components\Select::make('produto_id')
                            ->options(Produto::pluck('descricao_produto', 'id'))
                            ->live()
                            ->required(),

                        Forms\Components\Select::make('financeira_id')
                            ->options(
                                fn(Forms\Get $get): Collection => Tabela::with('financeira')->where('produto_id', $get('produto_id'))->get()->pluck('financeira.nome_financeira', 'financeira.id'))
                            ->live()
                            ->required(),

                        Forms\Components\Select::make('correspondente_id')
                            ->options(fn(Forms\Get $get): Collection => Tabela::with('correspondente')->where('financeira_id', $get('financeira_id'))->get()->pluck('correspondente.nome_correspondente', 'correspondente.id'))
                            ->live(debounce: 200)
                            ->required(),

                    ])->columns(['xl' => '4'])->columnSpan(['lg' => 'full']),

                    Forms\Components\Select::make('user_id')
                        ->label('Digitado por')
                        ->relationship('user', 'name')
                        ->required(),
                ]),

                Forms\Components\Section::make('Comissão')
                    ->relationship('comissao')->schema([

                        Forms\Components\Group::make([

                            Forms\Components\Select::make('organizacao_id')
                                ->options(Organizacao::pluck('nome_organizacao', 'id'))
                                ->live()
                                ->dehydrated(false)
                                ->afterStateUpdated(function ($state, Forms\Set $set): void {
                                    if(is_null($state)){
                                        $set('produto_id', null);
                                        $set('financeira_id', null);
                                        $set('correspondente_id', null);
                                    }
                                })
                                ->required(),

                            Forms\Components\Select::make('produto_id')
                                ->options(fn(Forms\Get $get): Collection => Tabela::with('produto')->where('organizacao_id', $get('organizacao_id'))
                                    ->get()->pluck('produto.descricao_produto', 'produto.id'))
                                ->dehydrated(false)
                                ->live()
                                ->required(),

                            Forms\Components\Select::make('financeira_id')
                                ->options(
                                    fn(Forms\Get $get): Collection => Tabela::with('financeira')->where('produto_id', $get('produto_id'))->get()->pluck('financeira.nome_financeira', 'financeira.id'))
                                ->dehydrated(false)
                                ->live()
                                ->required(),

                            Forms\Components\Select::make('correspondente_id')
                                ->options(fn(Forms\Get $get): Collection => Tabela::with('correspondente')->where('financeira_id', $get('financeira_id'))->get()->pluck('correspondente.nome_correspondente', 'correspondente.id'))
                                ->dehydrated(false)
                                ->live(debounce: 200)
                                ->required(),

                        ])->columns(['lg' => 4])->columnSpanFull()->visibleOn('create'),

                        Forms\Components\Group::make([
                            Forms\Components\Select::make('tabela_id')
                                ->label('Tabela')
                                ->options(function ($state, Forms\Get $get) {
                                        if(empty($get('organizacao_id')) || empty($get('produto_id')) || empty($get('financeira_id'))
                                            || empty($get('correspondente_id'))) {
                                            return Tabela::all()->pluck('descricao_codigo', 'id');
                                        } else {
                                            return Tabela::where('produto_id', $get('produto_id'))
                                                ->where('financeira_id', $get('financeira_id'))
                                                ->where('correspondente_id', $get('correspondente_id'))
                                                ->pluck('descricao_codigo', 'id');

                                        }
                                    } // end function
                                )// end options
                            //->relationship('tabela', 'descricao_codigo'),

                        ])->columnSpanFull(),

                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('percentual_loja')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(100.00)
                                ->default('0,00'),
                            Forms\Components\TextInput::make('valor_loja')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(10000000.00)
                                ->default('0,00'),
                        ]),

                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('percentual_agente')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(100.00)
                                ->default('0,00')
                            ,
                            Forms\Components\TextInput::make('valor_agente')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(10000000.00)
                                ->default('0,00'),
                        ]),

                        Forms\Components\Group::make([

                            Forms\Components\TextInput::make('percentual_corretor')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(100.00)
                                ->default('0,00'),

                            Forms\Components\TextInput::make('valor_corretor')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.00)
                                ->maxValue(10000000.00)
                                ->default('0,00'),
                        ]),

                    ])->collapsible()->columns(['lg' => 3]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
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
                        Average::make(),
                        Sum::make()
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
                        Average::make(),
                        Sum::make()
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

            ])->modifyQueryUsing(fn(BUilder $query) => !auth()->user()->hasRole(Utils::getSuperAdminName())
                ? $query->whereUserId(auth()->id())
                : $query->whereNotNull('user_id'))
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
