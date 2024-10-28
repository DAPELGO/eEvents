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
        'group_name',
        'group_slug',
        'slug',
        'is_delete',
        'id_user_created',
        'id_user_modified',
        'id_user_delete',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
