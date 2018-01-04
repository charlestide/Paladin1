<?php

namespace Charlestide\Paladin\Policies;


use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Models\Menu;

class MenuPolicy extends CrudPolicy
{

    public function visiable(Admin $admin, Menu $menu) {
        if ($menu->permission) {
            return $admin->allow($menu->permission->id);
        }
    }
}
