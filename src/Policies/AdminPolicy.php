<?php

namespace Charlestide\Paladin\Policies;

use Charlestide\Paladin\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy extends CrudPolicy
{
    use HandlesAuthorization;
}
