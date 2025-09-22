<?php

namespace App\Models\admin;

use App\Models\admin\Role;
use App\Models\admin\Article;
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

    public function article()
    {
        return $this->hasMany(Article::class, 'id_user_created');
    }
}
