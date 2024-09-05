<?php

namespace App\Filament\Midas\Resources;

use App\Filament\Midas\Resources\LigacaoResource\Pages;
use App\Filament\Midas\Resources\LigacaoResource\RelationManagers;
use App\Models\Ligacao;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LigacaoResource extends Resource
{
    protected static ?string $model = Ligacao::class;

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationLabel = 'Geral';

    protected static ?string $breadcrumb = 'Geral';

    protected static ?string $slug = 'call-center-ligacoes';

    protected static ?string $navigationGroup = 'Call Center';

    protected static ?string $navigationIcon = 'icon-headset';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Section::make([
                    Group::make([
                        Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name', modifyQueryUsing: fn(Builder $query): Builder => $query->whereId(auth()->id()))
                        ->default(auth()->user()->name),
                        Forms\Components\DatePicker::make('data_ligacao'),
                        Forms\Components\DatePicker::make('data_agendamento'),
                        Forms\Components\Select::make('status_id')
                        ->relationship('status', 'status'),
                    ])->columns(['lg' => 4]),

                    Group::make([

                        Forms\Components\TextInput::make('nome')
                            ->maxLength(255)
                            ->columnSpan(['lg' => 3]),
                        Forms\Components\TextInput::make('cpf')
                            ->maxLength(255)
                            ->default(null),
                    ])->columns(['lg' => 4]),

                    Group::make([
                        Forms\Components\Select::make('organizacao_id')
                            ->relationship('organizacao', 'nome_organizacao'),
                        Forms\Components\TextInput::make('orgao')->label('Seção | Secretaria')
                            ->maxLength(255)
                            ->default('Não informado'),
                        Forms\Components\Select::make('produto_id')
                            ->relationship('produto', 'descricao_produto')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('descricao_produto')->label('Produto'),
                            ])
                    ])->columns(['lg' => 4]),

                    Group::make([

                            Forms\Components\TextInput::make('matricula')
                            ->maxLength(255)
                            ->default(000),
                        Forms\Components\TextInput::make('margem')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0.000000),
                        Forms\Components\TextInput::make('telefone')
                        ->tel()
                            ->prefixIcon('heroicon-o-phone')
                            ->maxLength(255)
                            ->default('(84)9 0000-0000'),
                        Forms\Components\TextInput::make('produto')
                            ->maxLength(255)
                            ->default('Não informado'),
                            Forms\Components\Textarea::make('observacoes')->rows(5)
                            ->columnSpanFull(),
                    ])->columns(['lg' => 4]),
                ]),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status.status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('organizacao.nome_organizacao')
                    ->sortable(),
                Tables\Columns\TextColumn::make('produto.descricao_produto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_ligacao')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_agendamento')
                    ->date()
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
            ->modifyQueryUsing(fn(Builder $query): Builder => $query->where('user_id', auth()->user()->id))
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
            'index' => Pages\ListLigacaos::route('/'),
            'create' => Pages\CreateLigacao::route('/create'),
            'edit' => Pages\EditLigacao::route('/{record}/edit'),
        ];
    }
}
