<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 下午10:02
 */

namespace Charlestide\Paladin\Tests\Unit;

use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Policies\AdminPolicy;
use Charlestide\Paladin\Policies\MenuPolicy;
use Charlestide\Paladin\Policies\PermissionPolicy;
use Charlestide\Paladin\Services\AuthService;
use Charlestide\Paladin\Tests\Base\Base;
use Charlestide\Paladin\Tests\Base\Migrated;

class AuthServiceTest extends Base
{

    use Migrated;

    /**
     * @dataProvider policyDatas
     */
    public function testParsePolicy(string $modelClass,string $policyClass)
    {
        $authService = new AuthService();
        $permissions = $this->runInaccessableMethod($authService,'parsePolicy',[$modelClass,$policyClass]);

        $permission = collect($permissions)->random();
        $name = '';
        switch ($permission->action) {
            case 'index':
                $name = '浏览';
                break;
            case 'view':
                $name = '查看';
                break;
            case 'create':
                $name = '创建';
                break;
            case 'update':
                $name = '修改';
                break;
            case 'delete':
                $name = '删除';
                break;
        }
        $this->assertEquals($permission->name,$name);
        $this->assertEquals($permission->description,"拥有这个权限的用户，可以{$name}关联的对象");
    }

    public function policyDatas() {
        return [
            [Admin::class,AdminPolicy::class],
            [Menu::class,MenuPolicy::class],
            [Permission::class,PermissionPolicy::class]
        ];
    }
}
