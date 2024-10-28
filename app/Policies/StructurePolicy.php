<?php

namespace App\Policies;

use App\Models\admin\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class StructurePolicy
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
     * Determine whether the user can view the structure.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        return $this->getPermissions($admin, 'structure.view');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->getPermissions($admin, 'structure.create');
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function update(Admin $admin)
    {
        return $this->getPermissions($admin, 'structure.update');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\Admin $admin
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        return $this->getPermissions($admin, 'structure.delete');
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
