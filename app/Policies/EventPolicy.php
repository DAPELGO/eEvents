<?php

namespace App\Policies;

use App\Models\admin\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view the event.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        return $this->getPermissions($admin, 'event.view');
    }

    /**
     * Determine whether the user can create event.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->getPermissions($admin, 'event.create');
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function update(Admin $admin)
    {
        return $this->getPermissions($admin, 'event.update');
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \App\Admin $admin
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        return $this->getPermissions($admin, 'event.delete');
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
