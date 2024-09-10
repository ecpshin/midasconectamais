<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Usuários';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Filament Shield';
    protected static ?string $activeNavigationIcon = 'heroicon-s-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dados do novo usuário')->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DateTimePicker::make('email_verified_at')
                        ->label('Verificado em')
                        ->hidden()
                        ->default(now()),
                    Forms\Components\Select::make('tipo')->options([
                        'admin' => 'Admin',
                        'agente' => 'Agente',
                        'corretor' => 'Corretor'
                        ])->required()
                        ->default('agente'),
                    Forms\Components\Group::make([
                      Forms\Components\Repeater::make('custom_fields')->label('Dadss adicionais')->schema([

                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('cpf')
                            ->label('CPF')
                            ->mask('999.999.999-99'),
                            Forms\Components\TextInput::make('phone')
                            ->label('Contato')
                            ->mask('(99)9 9999-9999'),
                        ])->columns(['lg' => 2]),

                        Forms\Components\Group::make([
                            Forms\Components\TextInput::make('codigo')->label('Código')->columnSpan(['lg' => 1]),
                            Forms\Components\TextInput::make('banco')->label('Banco')->columnSpan(['lg' => 4]),
                            Forms\Components\TextInput::make('agencia')->label('Agência'),
                            Forms\Components\TextInput::make('conta')->label('Conta'),
                            Forms\Components\TextInput::make('tipo')->columnSpan(['lg' => 2]),
                            Forms\Components\TextInput::make('operacao')->label('Operação'),
                        ])->columns(['lg' => 5])
                      ])
                    ])->columnSpanFull()
                ])->columns(['lg' => 3]),

                Forms\Components\Section::make('Senha')->schema([
                    Forms\Components\TextInput::make('password')
                        ->label('Senha')
                        ->password()
                        ->revealable()
                        ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                        ->dehydrated(fn(?string $state): bool => filled($state))
                        ->required(fn(string $operation): bool => $operation === 'create'),
                    Forms\Components\TextInput::make('confirm_password')
                        ->label('Confirme a Senha')
                        ->password()
                        ->revealable()
                        ->same('password')
                        ->required(fn(string $operation): bool => $operation === 'create')
                        ->dehydrated(false),
                    ]),

                    Forms\Components\Section::make('Atribuir Funções')->schema([
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')->label("Funções")
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
