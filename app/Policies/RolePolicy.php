<?php

namespace App\Policies;

use App\Models\admin\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $role
     * @return mixed
     */
    public function view(Admin $user)
    {
        return $this->getPermissions($user, 'role.view');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        return $this->getPermissions($user, 'role.create');
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function update(Admin $user)
    {
        return $this->getPermissions($user, 'role.update');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function delete(Admin $user)
    {
        return $this->getPermissions($user, 'role.delete');
    }


    // GET PERMISSIONS
    protected function getPermissions($user, $permission_slug)
    {
        $roles = $user->roles;
        if (is_array($roles) || is_object($roles)){
            foreach ($roles as $role) {

                foreach ($role->permissions as $role_permit) {
                    if ($role_permit->slug == $permission_slug) {
                        return true;
                    }
                }
            }
        }


        return false;
    }
}
