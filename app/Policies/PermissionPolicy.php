<?php

namespace App\Policies;

use App\Models\admin\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
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
     * Determine whether the user can view the permission.
     *
     * @param  \App\Admin  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function view(Admin $user)
    {
        return $this->getPermissions($user, 'permission.view');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        return $this->getPermissions($user, 'permission.create');
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\Admin  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function update(Admin $user)
    {
        return $this->getPermissions($user, 'permission.update');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\Admin  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function delete(Admin $user)
    {
        return $this->getPermissions($user, 'permission.delete');
    }


    // GET PERMISSIONS
    protected function getPermissions($user, $permission_slug)
    {
        foreach ($user->roles as $role) {

            foreach ($role->permissions as $role_permit) {
                if ($role_permit->slug == $permission_slug) {
                    return true;
                }
            }
        }

        return false;
    }
}
