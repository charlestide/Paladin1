<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午12:51
 */

namespace Charlestide\Paladin\Tests\Unit;

use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Models\Role;
use Charlestide\Paladin\Policies\MenuPolicy;
use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Policies\Policy;
use Charlestide\Paladin\Tests\Base\Base;
use Charlestide\Paladin\Tests\Base\Migrated;

class PolicyTest extends Base
{
    use Migrated;

    /**
     * @var Permission
     */
    private $permission;

    /**
     * @var Admin
     */
    private $admin;

    /**
     * @var Menu
     */
    private $menu;

    /**
     * @var Policy
     */
    private $policy;

    protected function setUp()
    {
        parent::setUp();
        $this->runMigrate();
        $this->runSeeder();

        $this->permission = factory(Permission::class)->create([
            'action' => 'create',
            'object' => Role::class
        ]);
        $this->admin = factory(Admin::class)->create();
        $this->menu = factory(Menu::class)->create();
        $this->menu->permission()->associate($this->permission);
        $this->admin->permissions()->attach($this->permission);

        $this->policy = new Policy();
        $this->policy->setAllowActions(['create']);

    }

    public function testCan()
    {
        $this->assertTrue($this->policy->create($this->admin,Role::class));

        $this->admin->permissions()->detach($this->permission);
        $this->assertFalse($this->policy->create($this->admin,Role::class));
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testException() {
        $this->policy->update($this->admin,Role::class);
        $this->expectException(\BadMethodCallException::class);
    }
}
