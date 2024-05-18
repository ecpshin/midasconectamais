<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'data_nascimento',
        'phone',
        'codigo',
        'banco',
        'conta',
        'tipo_conta',
        'codigo_op',
        'tipo_chave_pix',
        'chave_pix',
        'path',
        'tipo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'data_nascimento' => 'date',
    ];

    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class, 'user_id', 'id');
    }

    public function propostas(): HasMany
    {
        return $this->hasMany(Proposta::class, 'user_id', 'id');
    }

    public function mailings(): BelongsToMany
    {
        return $this->belongsToMany(Mailing::class);
    }

    public function calls(): HasMany
    {
        return $this->hasMany(Ligacao::class);
    }
}
