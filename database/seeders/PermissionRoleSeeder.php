<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $permissions = [
        //     1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
        //     11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
        //     21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
        //     31, 32, 33, 34, 35, 36, 37, 38, 39, 40,
        //     41, 42, 43, 44, 45, 46, 47, 48, 49, 50,
        //     51, 52, 53, 54, 55, 56, 57, 58, 59, 60,
        //     61, 62, 63, 64, 65, 66, 67, 68, 69, 70,
        //     71, 72, 73, 74, 75, 76
        // ];

        $permissions = [
            1, 2, 3, 4, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 18, 19, 20, 21, 22, 24, 25, 26, 27, 28, 30, 31, 32, 33, 34, 36, 37, 38, 39, 40, 42, 49, 50, 51, 52, 54, 55, 72, 74
        ];

        $role = Role::find(4);
        $role->syncPermissions($permissions);
    }
}
