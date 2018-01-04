<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午12:51
 */

namespace Charlestide\Paladin\Tests\Unit;

use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Policies\MenuPolicy;
use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Tests\Base\Base;
use Charlestide\Paladin\Tests\Base\Migrated;

class MenuPolicyTest extends Base
{
    use Migrated;

    public function testVisiable()
    {
        $admin = factory(Admin::class)->create();
        $menu = factory(Menu::class)->create();
        $permssions = factory(Permission::class,2)->create();

        $menu->permission()->associate($permssions[0]);

        $admin->permissions()->attach($permssions[0]);

        $menuPolicy = new MenuPolicy();
        $this->assertTrue($menuPolicy->visiable($admin,$menu));

        $admin->permissions()->detach($permssions[0]);
        $admin->permissions()->attach($permssions[1]);
        $this->assertFalse($menuPolicy->visiable($admin,$menu));
    }

}
