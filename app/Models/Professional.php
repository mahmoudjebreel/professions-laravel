<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Professional extends Authenticatable
{
    use HasFactory, HasRoles;

    public function getFullNameAttribute()
    {
        return $this->user->first_name . " " . $this->user->last_name;
    }

    public function user()
    {
        return $this->morphOne(User::class, 'actor', 'actor_type', 'actor_id', 'id');
    }
}
