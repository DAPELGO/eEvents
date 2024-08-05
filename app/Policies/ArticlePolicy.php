<?php

namespace App\Policies;

use App\Models\user\User;
use App\Models\admin\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
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
     * Determine whether the user can view the article.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        return $this->getPermissions($admin, 'article.view');
    }

    /**
     * Determine whether the user can create article.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $this->getPermissions($admin, 'article.create');
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function update(Admin $admin)
    {
        return $this->getPermissions($admin, 'article.update');
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\Admin $admin
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        return $this->getPermissions($admin, 'article.delete');
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
