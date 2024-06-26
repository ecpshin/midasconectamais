<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'create cliente'],
            ['name' => 'edit cliente'],
            ['name' => 'list cliente'],
            ['name' => 'update cliente'],
            ['name' => 'delete cliente'],
            ['name' => 'view cliente'],
            ['name' => 'create organizacao'],
            ['name' => 'edit organizacao'],
            ['name' => 'list organizacao'],
            ['name' => 'update organizacao'],
            ['name' => 'delete organizacao'],
            ['name' => 'view organizacao'],
            ['name' => 'create infos'],
            ['name' => 'edit infos'],
            ['name' => 'list infos'],
            ['name' => 'update infos'],
            ['name' => 'delete infos'],
            ['name' => 'view infos'],
            ['name' => 'create financeira'],
            ['name' => 'edit financeira'],
            ['name' => 'list financeira'],
            ['name' => 'update financeira'],
            ['name' => 'delete financeira'],
            ['name' => 'view financeira'],
            ['name' => 'create correspondente'],
            ['name' => 'edit correspondente'],
            ['name' => 'list correspondente'],
            ['name' => 'update correspondente'],
            ['name' => 'delete correspondente'],
            ['name' => 'view correspondente'],
            ['name' => 'create operacao'],
            ['name' => 'edit operacao'],
            ['name' => 'list operacao'],
            ['name' => 'update operacao'],
            ['name' => 'delete operacao'],
            ['name' => 'view operacao'],
            ['name' => 'create situacao'],
            ['name' => 'edit situacao'],
            ['name' => 'list situacao'],
            ['name' => 'update situacao'],
            ['name' => 'delete situacao'],
            ['name' => 'view situacao'],
            ['name' => 'create tabela-comissao'],
            ['name' => 'edit tabela-comissao'],
            ['name' => 'list tabela-comissao'],
            ['name' => 'update tabela-comissao'],
            ['name' => 'delete tabela-comissao'],
            ['name' => 'view tabela-comissao'],
            ['name' => 'create vinculo'],
            ['name' => 'edit vinculo'],
            ['name' => 'list vinculo'],
            ['name' => 'update vinculo'],
            ['name' => 'delete vinculo'],
            ['name' => 'view vinculo'],
            ['name' => 'create permission'],
            ['name' => 'edit permission'],
            ['name' => 'list permission'],
            ['name' => 'update permission'],
            ['name' => 'delete permission'],
            ['name' => 'view permission'],
            ['name' => 'assign permission'],
            ['name' => 'revoke permission'],
            ['name' => 'assign permission'],
            ['name' => 'revoke permission'],
            ['name' => 'create role'],
            ['name' => 'edit role'],
            ['name' => 'list role'],
            ['name' => 'update role'],
            ['name' => 'delete role'],
            ['name' => 'view role'],
            ['name' => 'assign role'],
            ['name' => 'revoke role'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'list user'],
            ['name' => 'update user'],
            ['name' => 'delete user'],
            ['name' => 'view user'],
            ['name' => 'create proposta'],
            ['name' => 'edit proposta'],
            ['name' => 'list proposta'],
            ['name' => 'update proposta'],
            ['name' => 'delete proposta'],
            ['name' => 'view proposta'],
            ['name' => 'create comissao'],
            ['name' => 'edit comissao'],
            ['name' => 'list comissao'],
            ['name' => 'update comissao'],
            ['name' => 'delete comissao'],
            ['name' => 'view comissao'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
