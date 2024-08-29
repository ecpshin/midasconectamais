<?php

namespace App\Filament\Midas\Resources;

use App\Filament\Midas\Resources\ComissaoResource\Pages;
use App\Filament\Midas\Resources\ComissaoResource\RelationManagers;
use App\Models\Comissao;
use App\Models\Tabela;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComissaoResource extends Resource
{
    protected static ?string $model = Comissao::class;

    protected static ?string $modelLabel = 'Comissão';
    protected static ?string $pluralModelLabel = 'Comissões';

    protected static ?string $navigationGroup = 'Principal';
    protected static ?string $navigationParentItem = 'Propostas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Comissão')->schema([
                    Forms\Components\Fieldset::make()->schema([

                        Forms\Components\Select::make('tabela_id')
                            ->relationship('tabela', 'descricao_codigo
                            ')
                            ->searchable()
                            ->preload()
                            ->label('Tabela')
                            ->required()
                            ->optionsLimit(5),

                        Forms\Components\DatePicker::make('data_repasse')
                            ->label('Data do respasse')
                            ->date(),

                    ]),
                    Forms\Components\Fieldset::make('Valores')->schema([

                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('percentual_loja')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.0)
                                ->maxValue(100.00),
                            Forms\Components\TextInput::make('valor_loja')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.0)
                                ->maxValue(1000000.00),
                        ]),

                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('percentual_agente')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.0)
                                ->maxValue(100.00),
                            Forms\Components\TextInput::make('valor_agente')
                                ->numeric()->step(0.01)
                                ->minValue(0.0)
                                ->maxValue(1000000.00),
                        ]),

                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('percentual_corretor')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.0)
                                ->maxValue(100.00),
                            Forms\Components\TextInput::make('valor_corretor')
                                ->numeric()
                                ->step(0.01)
                                ->minValue(0.0)
                                ->maxValue(1000000.00),
                        ]),
                        Forms\Components\Toggle::make('is_pago')->label('Comissão Paga')
                            ->onColor(Color::Green)
                            ->offColor(Color::Red)
                    ])->columns(['xl' => 3]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposta.user.name')->label('Usuário'),
                Tables\Columns\TextColumn::make('proposta.total_proposta')->label('Total'),
                Tables\Columns\TextColumn::make('proposta.liquido_proposta')->label('Líquido'),
                Tables\Columns\TextColumn::make('tabela.descricao'),
                Tables\Columns\TextColumn::make('valor_agente')->label('Valor agente')->visible(auth()->user()->hasRole(config('filament-shield.midas_user.name'))),
                Tables\Columns\TextColumn::make('valor_corretor')->label('Valor corretor'),
                Tables\Columns\TextColumn::make('valor_loja')->visible(auth()->user()->hasRole(config('filament-shield.super_admin.name'))),
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
            RelationManagers\PropostaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComissaos::route('/'),
            'create' => Pages\CreateComissao::route('/create'),
            'edit' => Pages\EditComissao::route('/{record}/edit'),
        ];
    }
}
