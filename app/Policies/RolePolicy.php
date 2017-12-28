<?php

namespace App\Policies;

use App\Model\Admin;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function before(Admin $admin,$ablility)
    {
        if ($admin->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param  \  $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function view(Admin $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\Model\Admin $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\Model\Admin $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function update(Admin $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Model\Admin $user
     * @param  \App\Role  $role
     * @return mixed
     */
    public function delete(Admin $user, Role $role)
    {
        //
    }
}
