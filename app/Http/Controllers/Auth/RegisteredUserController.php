<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
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
            'path' => ['nullable', 'file|mime:jpg,jpeg,png,bmp'],
            'tipo' => ['nullable', 'string', 'max:50'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'cpf' => $request->cpf,
            'data_nascimento' => $request->data_nascimento,
            'phone' => $request->phone,
            'codigo' => $request->codigo,
            'banco' => $request->banco,
            'conta' => $request->conta,
            'agencia' => $request->agencia,
            'tipo_conta' => $request->tipo_conta,
            'codigo_op' => $request->codigo_op,
            'tipo_chave_pix' => $request->tipo_chave_pix,
            'chave_pix' => $request->chave_pix,
            'path' => $request->picture,
            'tipo' => $request->tipo
        ]);

        $user->assignRole('none');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
