<?php

namespace App\Models\admin;

use App\Models\admin\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Permission extends Model
{
    use Notifiable;
    protected $fillable = [
        'nom_permission',
        'slug'
    ];


    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }
}
