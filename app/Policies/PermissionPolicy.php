<?php

namespace App\Policies;

use App\Model\Admin;
use App\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function before(Admin $admin,$ablility)
    {
        if ($admin->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the permission.
     *
     * @param  \App\Model\Admin  $user
     * @param  \App\Model\Permission  $permission
     * @return mixed
     */
    public function view(Admin $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\Model\Admin $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\Model\Admin $user
     * @param  \App\Model\Permission  $permission
     * @return mixed
     */
    public function update(Admin $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\Model\Admin $user
     * @param  \App\Model\Permission  $permission
     * @return mixed
     */
    public function delete(Admin $user, Permission $permission)
    {
        //
    }
}
