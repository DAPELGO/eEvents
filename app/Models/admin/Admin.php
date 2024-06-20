<?php

namespace App\Models\admin;

use App\Models\admin\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role_slug)
    {
        if ($this->roles()->where('slug', $role_slug)->first()) {
            return true;
        }
        return false;
    }
}
