<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午2:33
 */

namespace Charlestide\Paladin\Tests\Unit;

use Charlestide\Paladin\ModelFactories\Factory;
use Charlestide\Paladin\ModelFactories\FactoryManager;
use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Models\Role;
use Charlestide\Paladin\Tests\Base\Base;
use Charlestide\Paladin\Tests\Base\Migrated;
use Illuminate\Support\Collection;

class AdminTest extends Base
{
    use Migrated;

    public function testAllowPermission()
    {
        $permissions = factory(Permission::class,20)->create();
        $admins = factory(Admin::class,3)->create();
        $roles = factory(Role::class,10)->create();

        $results = collect();
        foreach ($admins as $index => $admin) {
            $permissionGroup = $permissions->random(rand(2,3));
            $roleGroup = $roles->random(3);

            switch ($admin->id % 3) {
                //直接向admin分配权限
                case 0:
                    $admin->permissions()->attach($permissionGroup->pluck('id'));
                    $results->put($admin->id, $permissionGroup);
                    break;
                //通过role分配权限,只给第一个角色分配权限
                case 1:
                    $rolePermissions = $permissionGroup->random(2);
                    $roleGroup->get(0)->permissions()->attach($rolePermissions->pluck('id'));
                    foreach ($roleGroup as $r) {
                        $rolePermissions->merge($r->permissions);
                    }
                    $admin->roles()->attach($roleGroup->pluck('id'));
                    $results->put($admin->id, $rolePermissions);
                    break;
                //不分配权限
                case 2:
                    $results->put($admin->id,collect());
                    break;
            }
        }

        foreach ($admins as $admin) {
            $selfPermissions = $results->get($admin->id);
            if ($selfPermissions->count() and $permission = $selfPermissions->random()) {
                $this->assertTrue($admin->allow($permission->id),"adminId:{$admin->id}  permission: {$permission->id} in {$selfPermissions->pluck('name')}");
                $this->assertFalse($admin->allow($permissions->diff($selfPermissions)->random()->id),"admin:{$admin->id} permission: {$permissions->diff($selfPermissions)->random()->id} in {$selfPermissions->pluck('name')}");
            } else {
                $this->assertFalse($admin->allow($permissions->random()->id));
            }
        }

    }
}
