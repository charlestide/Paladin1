<?php

namespace Charlestide\Paladin\Policies;

use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy extends CrudPolicy
{
    protected $defaultObjectClass = Permission::class;
}
