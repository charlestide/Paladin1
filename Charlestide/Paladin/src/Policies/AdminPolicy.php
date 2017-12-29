<?php

namespace Charlestide\Paladin\Policies;

use Charlestide\Paladin\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function before(Admin $user, $ablility)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \Charlestide\Paladin\Models\Admin  $user
     * @param  \Charlestide\Paladin\Models\Admin  $admin
     * @return mixed
     */
    public function view(Admin $user, Admin $admin)
    {
        return $user->permissions()->where('name','admin.view')->count();
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \Charlestide\Paladin\Models\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \Charlestide\Paladin\Models\Admin  $user
     * @param  \Charlestide\Paladin\Models\Admin  $admin
     * @return mixed
     */
    public function update(Admin $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \Charlestide\Paladin\Models\Admin  $user
     * @param  \Charlestide\Paladin\Models\Admin  $admin
     * @return mixed
     */
    public function delete(\Charlestide\Paladin\Models\Admin $user, Admin $admin)
    {
        //
    }
}
