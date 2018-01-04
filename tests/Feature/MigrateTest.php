<?php

namespace Charlestide\Paladin\Tests\Feature;

use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Tests\Base\Base;
use Charlestide\Paladin\Tests\Base\Migrated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MigrateTest extends Base
{
    use Migrated;

    public function testAdmin()
    {
        $this->assertDatabaseHas('admins',[
            'id' => 1,
            'name' => 'admin',
        ]);
        $admin = DB::table('admins')->where('id',1)->first();
        $this->assertTrue(
            Hash::check('123456',$admin->password)
        );
    }

    public function testRoles() {

        $this->assertTrue(
            Schema::hasTable('roles')
        );
        $this->assertTrue(
            Schema::hasTable('role_admin_relations')
        );
    }

    public function testPermissions() {

        $this->assertTrue(
            Schema::hasTable('permissions')
        );
        $this->assertTrue(
            Schema::hasTable('permission_relations')
        );
    }

    public function testMenus() {
        $this->assertTrue(
            Schema::hasTable('menu')
        );

        $names = collect(['系统管理','管理员','权限','角色','菜单管理','开发工具','生成工具','CRUD']);

        Menu::all()->each(function(Menu $menu) use ($names){
            $this->assertFalse($names->search($menu->name) === false);
            $this->assertFalse(empty($menu->permission),$menu->name.'的菜单关联的权限ID是'.$menu->permission_id.' 但未找到权限');
            $this->assertGreaterThan(0,$menu->permission->id,"{$menu->name}的菜单关联权限ID是 {$menu->permission_id}, 但未找到权限");
        });

        $this->assertEquals(Menu::whereIn('name',$names->toArray())->count(),$names->count());
    }
}
