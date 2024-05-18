<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AgentesService
{
    public function getAgentes(): Collection
    {
        return User::whereNotIn('user_id', [1,2,9])->get();
    }

    public function getAgenteById(): Collection
    {
        return User::whereNotIn('user_id', [1,2,9])->get();
    }
}