<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $table ='statuses';

    protected $fillable = ['status_description'];

    public function calls(): HasMany
    {
        return $this->hasMany(Ligacao::class, 'status_id', 'id');
    }
}
