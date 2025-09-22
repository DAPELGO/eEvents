<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParametrePolicy
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
     * Determine whether the user can view the parametre.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $parametre
     * @return mixed
     */
    public function view(User $user)
    {
        return $this->getPermissions($user, 'parametre.view');
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->getPermissions($user, 'parametre.create');
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->getPermissions($user, 'parametre.update');
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\User  $user
     * @param  \App\Permission  $permission
     * @return mixed
     */
    public function delete(User $user)
    {
        return $this->getPermissions($user, 'parametre.delete');
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
