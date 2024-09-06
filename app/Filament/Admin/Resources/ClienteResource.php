<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use App\Models\Cliente;
use App\Models\EstadoCivil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationGroup = 'Principal';

    protected static ?string $navigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('nome')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('cpf')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\DatePicker::make('data_nascimento'),
                    ])->columns(['xl'=>2]),

                    Forms\Components\Group::make([
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
                    ])->columnSpan(['xl' => 'full'])->columns(['xl' => 4]),

                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('genitora')
                            ->maxLength(100)
                            ->default('Não informado'),
                        Forms\Components\TextInput::make('genitor')
                            ->maxLength(100)
                            ->default('Não informado'),
                        Forms\Components\TextInput::make('sexo')
                            ->maxLength(50)
                            ->default('Masculino'),
                        Forms\Components\Select::make('estado_civil')
                            ->options(EstadoCivil::all()->pluck('estado_civil', 'estado_civil')->toArray())
                            ->createOptionForm([
                                Forms\Components\TextInput::make('estado_civil')
                            ])->createOptionUsing(function (array $data): string {
                               $estado = EstadoCivil::create($data);
                               return $estado->get('estado_civil');
                            }),
                    ])->columnSpan(['xl' => 'full'])->columns(['xl' => 4]),

                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make('phone1')
                            ->tel()
                            ->maxLength(50)
                            ->mask('(84)9 9999-9999')
                            ->default('99999999999'),
                        Forms\Components\TextInput::make('phone2')
                            ->tel()
                            ->mask('(84)9 9999-9999')
                            ->maxLength(50)
                            ->default('99999999999'),
                        Forms\Components\TextInput::make('phone3')
                            ->tel()
                            ->mask('(84)9 9999-9999')
                            ->maxLength(50)
                            ->default('99999999999'),
                        Forms\Components\TextInput::make('phone4')
                            ->tel()
                            ->mask('(84)9 9999-9999')
                            ->maxLength(50)
                            ->default('99999999999'),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required(),
                        Forms\Components\Textarea::make('observacoes')
                            ->label('Observações')->default(null)
                            ->columnSpanFull(),
                    ])->columnSpan(['xl' => 'full'])->columns(['xl' => 5]),

                ])->columns(['xl' => 2]),

                Forms\Components\Section::make('Dados Residenciais')->schema([
                    Forms\Components\Repeater::make('residenciais')->schema([
                      Forms\Components\TextInput::make('cep'),
                      Forms\Components\TextInput::make('logradouro'),
                      Forms\Components\TextInput::make('complemento'),
                      Forms\Components\TextInput::make('bairro'),
                      Forms\Components\TextInput::make('localidade'),
                      Forms\Components\TextInput::make('uf'),
                    ])->columns(['xl' => 3]),
                ])->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_nascimento')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('rg')
                    ->searchable(),
                Tables\Columns\TextColumn::make('orgao_exp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_exp')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Agente')
                    ->relationship('user', 'name')
            ], Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->orderByDesc('id'))
            ;
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Admin\Resources\ClienteResource\RelationManagers\PropostaRelationManager::class,
            \App\Filament\Admin\Resources\ClienteResource\RelationManagers\InfoResidencialRelationManager::class,
            \App\Filament\Admin\Resources\ClienteResource\RelationManagers\InfoBancariasRelationManager::class,
            \App\Filament\Admin\Resources\ClienteResource\RelationManagers\VinculosRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\ClienteResource\Pages\ListClientes::route('/'),
            'create' => \App\Filament\Admin\Resources\ClienteResource\Pages\CreateCliente::route('/create'),
            'edit' => \App\Filament\Admin\Resources\ClienteResource\Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
