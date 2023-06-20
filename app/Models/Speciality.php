<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    // protected $appends = ['activity_status'];

    public function getActivityStatusAttribute()
    {
        return $this->active ? 'Active' : 'In-Active';
    }
    /*
    public function get___Attribute(){}
    */

    public function professions()
    {
        return $this->hasMany(Profession::class, 'speciality_id', 'id');
    }
}
