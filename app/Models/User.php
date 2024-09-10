<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use BezhanSalleh\FilamentShield\Support\Utils;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use Notifiable;
    use HasRoles;
    use HasPanelShield;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'avatar_url',
        'custom_fields'
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
        'password' => 'hashed'
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

    protected static function booted(): void
    {
        if(config('filament-shield.midas_user.enabled', false))
        {
            FilamentShield::createRole(config('filament-shield.midas_user.name', 'midas_user'));

            static::created(function(User $user) {
                $user->assignRole(config('filament-shield.midas_user.name', 'midas_role'));
            });

            static::deleting(function(User $user){
                $user->removeRole(config('filament-shield.midas_user.name', 'midas_user'));
            });
        }
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasRole(Utils::getSuperAdminName());
        } else if($panel->getId() === 'midas')
        {
            return $this->hasRole(config('filament-shield.midas_user.name', 'midas_user'));
        } else {
            return false;
        }

    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url("$this->avatar_url") : null;
    }
}
