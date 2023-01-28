<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public function roles(){
        return $this->belongsToMany(Role::class, 'roles_permission');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'users_permissions');
    }
}
