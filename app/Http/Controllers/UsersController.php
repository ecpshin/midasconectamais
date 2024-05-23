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
    /**
     * Display a listing of the resource.
     */
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
        return view('admin.agentes.edit', [
            'area' => 'Administração',
            'page' => 'Agentes',
            'rota' => 'admin.agentes.index',
            'agente' => $user,
            'permissions' => $user->getPermissionsViaRoles(),
            'role' => $user->getRoleNames()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
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
            'picture' => ['nullable', File::image()->max('10mb')]
        ]);

        if ($request->hasFile('picture')) {
            $fileComExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($fileComExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('picture')->storeAs('public/img/users', $fileNameToStore);
            $attributes['path'] = str_replace('public/', '', $path);
        }
        $user->update($attributes);
        Alert::success('Sucesso', 'Os dados de ' . $user->name . ' foram atualizados com sucesso!');
        return redirect()->route('admin.agentes.index');
    }

    public function senhaUpdate(Request $request, User $user)
    {
        $rules = ['password' => 'min:3|confirmed'];
        $feedback = ['min' => 'A senha deve ter no mínimo :min caracteres', 'confirmed' => 'A senhas não conferem.'];
        $attributes = $request->validate($rules, $feedback);
        $attributes['password'] = Hash::make($attributes['password']);
        $user->update($attributes);
        return redirect()->route('admin.agentes.index')->with('success', 'A senha foi de ' . $user->name . ' atualizada com sucesso.');
    }
}
