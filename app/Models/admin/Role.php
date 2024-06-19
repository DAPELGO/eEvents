<?php

namespace App\Models\admin;

use App\Models\admin\Admin;
use App\Models\admin\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use Notifiable;
    protected $fillable = [
        'nom_role',
        'slug',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }
}
