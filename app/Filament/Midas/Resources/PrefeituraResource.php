<?php

namespace App\Filament\Midas\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Prefeitura;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Midas\Resources\PrefeituraResource\Pages;
use App\Filament\Midas\Resources\PrefeituraResource\RelationManagers;

class PrefeituraResource extends Resource
{
    protected static ?string $model = Prefeitura::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Call Center';

    protected static ?string $navigationIcon = 'heroicon-s-phone-arrow-up-right';

    public static function form(Form $form): Form
    {

        $user = auth()->user()->hasRole(Utils::getSuperAdminName());
        $users = User::where(function ($query) use ($user) {
            $user ? $query->whereNotIn('id', [1,2,9,10]) : $query->whereNotIn('id', [1,2,9,10])->where('id', auth()->id());
        })->get()->pluck('name', 'id');

        return $form
        ->schema([
            Forms\Components\Section::make([
                Forms\Components\Select::make('user_id')
                    ->options($users)
                    ->default($user ? null : auth()->id()),
                Forms\Components\Select::make('status_id')
                    ->relationship('status', 'status')
                    ->default(1),
                Forms\Components\Select::make('organizacao_id')
                    ->relationship('organizacao', 'nome_organizacao')                    ,
                Forms\Components\Select::make('produto_id')
                    ->relationship('produto', 'descricao_produto'),
            ])->columns(['xl' => 4]),
            Forms\Components\Section::make([
                Forms\Components\DatePicker::make('data_ligacao'),
                Forms\Components\DatePicker::make('data_agendamento'),
            ])->columns(['xl' => 2]),
            Forms\Components\Section::make([
                Forms\Components\TextInput::make('nome')
                    ->maxLength(255)
                    ->columnSpan(['xl' => 3])
                    ->default(null),
                Forms\Components\TextInput::make('cpf')
                    ->mask('999.999.999-99')
                    ->maxLength(14)
                    ->columnSpan(['xl' => 1])
                    ->default(null),
            ])->columns(['xl' => 4]),
            Forms\Components\Section::make([
                Forms\Components\TextInput::make('matricula')
                    ->maxLength(50)
                    ->default('000000'),
                Forms\Components\TextInput::make('margem')
                    ->numeric()
                    ->minValue(0.00)
                    ->maxValue(1000000.00)
                    ->step(0.00)
                    ->default('0.00'),
                Forms\Components\TextInput::make('telefone')
                    ->tel()
                    ->mask('(99)9 9999-9999')
                    ->maxLength(50)
                    ->default('(84)9 0000-0000'),
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('orgao')
                        ->maxLength(255)
                        ->readOnly(true)
                        ->default('Não informado'),
                    Forms\Components\Select::make('produto_id')
                        ->relationship('produto', 'descricao_produto'),
                ])->columns(['xl'=>2])->columnSpan(['xl' => 'full']),
                Forms\Components\Textarea::make('observacoes')
                    ->columnSpanFull(),
            ])->columns(['xl' => 3]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('user.name')
                ->label('Agente')
                ->sortable(),
            Tables\Columns\TextColumn::make('data_ligacao')
                ->sortable(),
            Tables\Columns\TextColumn::make('data_agendamento')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('status.status')
                ->sortable(),
            Tables\Columns\TextColumn::make('nome')
                ->searchable(),
            Tables\Columns\TextColumn::make('cpf')
                ->searchable(),
            Tables\Columns\TextColumn::make('telefone')
                ->searchable(),
            Tables\Columns\TextColumn::make('orgao')
                ->searchable(),
        ])
        ->filters([

        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])->modifyQueryUsing(function (Builder $query): Builder  {
            return $query->where('user_id', '=',null, 'and')
                ->where('orgao', 'like', 'pref%');
        });
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
            'index' => Pages\ListPrefeituras::route('/'),
            'create' => Pages\CreatePrefeitura::route('/create'),
            'edit' => Pages\EditPrefeitura::route('/{record}/edit'),
        ];
    }
}
