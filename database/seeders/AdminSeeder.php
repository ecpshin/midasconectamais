<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super = User::create([
            'name' => 'Maria Zilda',
            'email' => 'zilda@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'cpf' => '123.456.789-00',
            'data_nascimento' => now(),
            'phone' => '(84)90000-0000',
            'codigo' => '104',
            'banco' => 'CEF',
            'conta' => '123',
            'tipo_conta' => 'Conta Corrente',
            'codigo_op' => '001',
            'tipo_chave_pix' => 'Não informado',
            'chave_pix' => 'Não informado',
            'picture' => 'user.png'
        ]);

        $super->assignRole('super-admin');

        $super2 = User::create([
            'name' => 'Andretti Leno',
            'email' => 'andretti@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'cpf' => '124.356.789-00',
            'data_nascimento' => now(),
            'phone' => '(84)90000-0000',
            'codigo' => '104',
            'banco' => 'CEF',
            'conta' => '123',
            'tipo_conta' => 'Conta Corrente',
            'codigo_op' => '001',
            'tipo_chave_pix' => 'Não informado',
            'chave_pix' => 'Não informado',
            'picture' => 'user.png'
        ]);

        $super2->assignRole('super-admin');

        $user = User::create([
            'name' => 'Jhon Doe',
            'email' => 'johndoe@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'cpf' => '122.356.789-00',
            'data_nascimento' => now(),
            'phone' => '(84)90000-0000',
            'codigo' => '104',
            'banco' => 'CEF',
            'conta' => '123',
            'tipo_conta' => 'Conta Corrente',
            'codigo_op' => '001',
            'tipo_chave_pix' => 'Não informado',
            'chave_pix' => 'Não informado',
            'picture' => 'user.png'
        ]);

        $user->assignRole('user');
    }
}
