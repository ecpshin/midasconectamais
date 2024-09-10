<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\LigacaoResource\Pages;
use App\Filament\Resources\LigacaoResource\RelationManagers;
use App\Models\Cliente;
use App\Models\Ligacao;
use App\Models\User;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LigacaoResource extends Resource
{
    protected static ?string $model = Ligacao::class;
    protected static ?string $slug = 'ligacoes';
    protected static ?string $modelLabel = 'Ligação';
    protected static ?string $pluralModelLabel = 'Ligações';
    protected static ?string $navigationGroup = 'Call Center';
    protected static ?string $navigationLabel = 'Ligações Realizadas';
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
                Tables\Columns\TextColumn::make('status.status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('organizacao.nome_organizacao')
                    ->sortable(),
                Tables\Columns\TextColumn::make('produto.descricao_produto')
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_ligacao')
                    ->date('d/m/Y')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('orgao')
                    ->searchable(),
            ])
            ->modifyQueryUsing(
                function(Builder $query): Builder
                {
                    if(auth()->user()->hasRole(Utils::getSuperAdminName()))
                    {
                        return $query->whereNotNull('user_id');
                    } else {
                        return $query->where('user_id', auth()->user()->id);
                    }
                })
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Transferir')
                    ->color(Color::Blue)
                    ->icon('heroicon-o-arrows-right-left')
                    ->action(function (Ligacao $record)
                    {
                        $data = $record->toArray();

                        $obs = ' orgão: '. $data['organizacao']['nome_organizacao'] .', margem: R$   '. $data['margem'] . ', matrícula: ' . $data['matricula'];

                        $cliente = [
                            "nome" => $data['nome'],
                            "cpf" => $data['cpf'],
                            "phone1" => $data['telefone'],
                            "observacoes" => is_null($data['observacoes']) ? $obs : $data['observacoes']. "\r\n". $obs,
                            "user_id" => $data['user_id']
                        ];

                        Cliente::create($cliente);

                        return Notification::make()
                            ->title('Transferência realizada com sucesso!' )
                            ->send()->icon('heroicon-o-exclamation-circle')
                            ->iconColor(Color::Green);

                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => \App\Filament\Admin\Resources\LigacaoResource\Pages\ManageLigacaos::route('/'),
        ];
    }
}
