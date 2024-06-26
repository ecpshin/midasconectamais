<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {

        return view('admin.roles.index', [
            'area' => 'Niveis',
            'page' => 'Niveis de Acesso',
            'rota' => 'admin.roles.index',
            'roles' => Role::paginate(5)
        ]);
    }

    public function create()
    {
        $permissions = Permission::all(['id', 'name']);
        return view('admin.roles.create', [
            'area' => 'Niveis',
            'page' => 'Niveis de Acesso',
            'rota' => 'admin.roles.index',
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $role->syncPermissions($request->permissions);
        Alert::success('Yeahh', 'Cadastro realizado com sucesso!');
        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role)
    {
        $rolePermissions = $role->getAllPermissions();
        $permissions = Permission::all();
        $perms = $permissions->diff($rolePermissions);

        return view('admin.roles.edit', [
            'area' => 'Niveis',
            'page' => 'Niveis de Acesso',
            'rota' => 'admin.roles.index',
            'role' => $role,
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions,
            'perms' => $perms
        ]);
    }

    public function edit(Role $role)
    {
        $rolePermissions = $role->getAllPermissions();
        $permissions = Permission::all();
        $perms = $permissions->diff($rolePermissions);
        return view('admin.roles.edit', [
            'area' => 'Niveis',
            'page' => 'Niveis de Acesso',
            'rota' => 'admin.roles.index',
            'role' => $role,
            'rolePermissions' => $rolePermissions,
            'perms' => $perms
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions);
        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        $permissions = $role->getAllPermissions();
        foreach ($permissions as $permission) {
            $role->revokePermissionTo($permission);
        }
        $role->delete();
        Alert::warning('Humm', 'Exclusão realizada com sucesso!');
        return redirect()->back();
    }
}
