<?php

namespace App\Policies;

use App\Models\admin\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Determine whether the user can view the user.
     *
     * @param  \App\Admin  $admin
     * @param  \App\Permission  $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        return $this->getPermissions($admin, 'user.view');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\User  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->getPermissions($admin, 'user.create');
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\User  $admin
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function update(Admin $admin)
    {
        return $this->getPermissions($admin, 'user.update');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\User  $admin
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        return $this->getPermissions($admin, 'user.delete');
    }


    // GET PERMISSIONS
    protected function getPermissions($admin, $permission_slug)
    {
        foreach ($admin->roles as $role) {

            foreach ($role->permissions as $role_permit) {
                if ($role_permit->slug == $permission_slug) {
                    return true;
                }
            }
        }

        return false;
    }
}
