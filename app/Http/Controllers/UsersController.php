<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\validation\Rules\File;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:create user', ['only' => ['create']]);
        $this->middleware('can:edit user', ['only' => ['edit', 'update']]);
        $this->middleware('can:update user', ['only' => ['update']]);
        $this->middleware('can:list user', ['only' => ['index']]);
        $this->middleware('can:view user', ['only' => ['show']]);
    }

    public function index()
    {
        $users = User::all();
        return view('admin.agentes.index', [
            'area' => 'Administração',
            'page' => 'Agentes',
            'rota' => 'admin.agentes.index',
            'agentes' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.agentes.create', [
            'area' => 'Administração',
            'page' => 'Registrar Agente',
            'rota' => 'admin.agentes.index',
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf' => ['nullable', 'string', 'max:14', 'unique:users,cpf'],
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
            'picture' => ['nullable', 'file|mime:jpg,jpeg,png,bmp']
        ]);


        $user = User::create($attributes);
        Alert::success('Ok', 'Agente cadastrado com sucesso.');
        return (auth()->user()->hasRole('super-admin')) ? redirect()->route('admin.agentes.index') : redirect()->route('admin');
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
        return view('admin.agentes.edit', [
            'area' => 'Administração',
            'page' => 'Agentes',
            'rota' => 'admin.agentes.index',
            'agente' => $user,
            'permissions' => $user->getPermissionsViaRoles(),
            'role' => $user->getRoleNames()
        ]);
    }

    public function update(Request $request, User $user)
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
            'picture' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'max: ' . (1024 * 20)]
        ]);

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileComExt = $file->getClientOriginalName();
            $filename = pathinfo($fileComExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('picture')->storeAs('img/users/' . str_ireplace(' ', '_', $user->name) . '/', $fileNameToStore);
            $attributes['path'] = $path;
        }
        $user->update($attributes);
        Alert::success('Sucesso', 'Os dados de ' . $user->name . ' foram atualizados com sucesso!');
        return (auth()->user()->hasRole('super-admin')) ? redirect()->route('admin.agentes.index') : redirect()->route('admin');
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
            'picture' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'max: ' . (1024 * 20)]
        ]);

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileComExt = $file->getClientOriginalName();
            $filename = pathinfo($fileComExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('picture')->storeAs('img/users/' . str_ireplace(' ', '_', $user->name) . '/', $fileNameToStore);
            $attributes['path'] = $path;
        }
        $user->update($attributes);
        Alert::success('Sucesso', 'Os dados de ' . $user->name . ' foram atualizados com sucesso!');
        return (auth()->user()->hasRole('super-admin')) ? redirect()->route('admin.agentes.index') : redirect()->route('admin');
    }

    public function senhaUpdate(Request $request, User $user)
    {
        $rules = ['password' => 'min:3|confirmed'];
        $feedback = ['min' => 'A senha deve ter no mínimo :min caracteres', 'confirmed' => 'A senhas não conferem.'];
        $attributes = $request->validate($rules, $feedback);
        $attributes['password'] = Hash::make($attributes['password']);
        $user->update($attributes);
        Alert::success('Atualização', $user->name . ' sua senha foi atualizada com sucesso.')
        return (auth()->user()->hasRole('super-admin')) ? redirect()->route('admin.agentes.index') : redirect()->route('admin');
    }
}
