<?php

namespace App\Policies;

use App\Model\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Cache;

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
     * @param  \App\Model\Admin  $user
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function view(Admin $user, Admin $admin)
    {
        return $user->permissions()->where('name','admin.view')->count();
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\Model\Admin  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\Model\Admin  $user
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function update(Admin $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\Model\Admin  $user
     * @param  \App\Model\Admin  $admin
     * @return mixed
     */
    public function delete(\App\Model\Admin $user, Admin $admin)
    {
        //
    }
}
