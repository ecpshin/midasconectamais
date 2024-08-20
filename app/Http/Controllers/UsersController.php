<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\validation\Rules\File;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:create user', ['only' => ['create', 'store']]);
        $this->middleware('can:edit user', ['only' => ['edit']]);
        $this->middleware('can:update user', ['only' => ['update']]);
        $this->middleware('can:delete user', ['only' => ['destroy']]);
        $this->middleware('can:list user', ['only' => ['index']]);
        $this->middleware('can:view user', ['only' => ['view']]);
    }

    public function index()
    {
        if (auth()->user()->hasRole('super-admin')) {
            $users = User::all();
        } else {
            $users = User::whereNotIn('id', ['1,2'])->get();
        }

        return view('admin.agentes.index', [
            'area' => 'Administração',
            'page' => 'Agentes',
            'rota' => 'admin.agentes.index',
            'agentes' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agentes.create', [
            'area' => 'Administração',
            'page' => 'Registrar Agente',
            'rota' => 'admin.agentes.index',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf' => ['nullable', 'string', 'max:14', 'unique:' . User::class],
            'data_nascimento' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:25'],
            'codigo' => ['nullable', 'string', 'max:25'],
            'banco' => ['nullable', 'string', 'max:255'],
            'conta' => ['nullable', 'string', 'max:50'],
            'agencia' => ['nullable', 'string', 'max:25'],
            'tipo_conta' => ['nullable', 'string', 'max:50'],
            'codigo_op' => ['nullable', 'string', 'max:50'],
            'tipo_chave_pix' => ['nullable', 'string', 'max:50'],
            'chave_pix' => ['nullable', 'string', 'max:50'],
            'picture' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp']
        ]);
        $attributes['password'] = Hash::make($request->password);
        $user = User::create($attributes);
        $user->assignRole('user');
        Alert::success('Ok', 'Cadastro realizado com sucesso.');
        return redirect()->route('admin.agentes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        $role = $user->getRoleNames();
        $rolePermissions = $user->getPermissionsViaRoles();
        $permissions = Permission::all();
        $perms = $permissions->diff($rolePermissions);

        return view('admin.agentes.edit', [
            'area' => 'Administração',
            'page' => 'Agentes',
            'rota' => 'admin.agentes.index',
            'agente' => $user,
            'rolePermissions' => $rolePermissions,
            'perms' => $perms,
            'role' => (count($role)) > 0 ? $role[0] : 'Não atribuído'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function pessoais(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:14'],
            'data_nascimento' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:25'],
            'codigo' => ['nullable', 'string', 'max:25'],
            'banco' => ['nullable', 'string', 'max:255'],
            'conta' => ['nullable', 'string', 'max:50'],
            'agencia' => ['nullable', 'string', 'max:25'],
            'tipo_conta' => ['nullable', 'string', 'max:50'],
            'codigo_op' => ['nullable', 'string', 'max:50'],
            'tipo_chave_pix' => ['nullable', 'string', 'max:50'],
            'chave_pix' => ['nullable', 'string', 'max:50'],
            'tipo' => ['nullable', 'string', 'min:3', 'max:50'],
            'picture' => ['bail', 'mimes:jpg,jpeg,png,bmp', 'max: 10240']
        ]);

        if ($request->hasFile('picture')) {
            $file =  $request->file('picture');
            $fileNameToStore = $file->getClientOriginalName();
            $path = $file->storeAs('img/users/' . str_ireplace(' ', '_', $user->name) . '/', $fileNameToStore);
            $attributes['path'] = $path;
        }
        $user->update($attributes);
        alert()->success('Sucesso', 'Os dados de ' . $user->name . ' foram atualizados com sucesso!');
        return redirect()->route('admin');
    }

    public function senhaUpdate(Request $request, User $user)
    {
        $rules = ['password' => 'min:3|max:16|confirmed'];
        $feedback = [
            'min' => 'A senha deve ter no mínimo :min caracteres',
            'max' => 'A senha deve ter no mánimo :max caracteres',
            'confirmed' => 'A senhas não conferem.'
        ];

        $attributes = $request->validate($rules, $feedback);

        $password = $attributes['password'];

        $attributes['password'] = Hash::make($password);

        $user->update($attributes);

        Alert::success('OK', 'A senha foi de ' . $user->name . ' atualizada com sucesso.');

        return redirect()->route('admin');
    }
}
