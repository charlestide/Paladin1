<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $systemId = $this->createMenu('系统管理','',0,'system.index','gear');
        $this->createMenu('管理员','/admin',$systemId,'admin.index','users');
        $this->createMenu('角色','/role',$systemId,'role.index','user');
        $this->createMenu('权限','/permission',$systemId,'permission.index','user-secret');
        $this->createMenu('菜单管理','/menu',$systemId,'menu.index','list-ul');

        $devToolId = $this->createMenu('开发工具','',0,'devtool.index','magic');
        $generatorId = $this->createMenu('生成工具','',$devToolId,'generator.index','bolt');
        $this->createMenu('CRUD','/generator/crud',$generatorId,'generator.crud');
    }

    public function createMenu($name,$url,$parentId = 0,$permissionName,$icon = null) {

        $permissionId = DB::table('permissions')->where('name',$permissionName)->value('id');

        return DB::table('menu')->insertGetId([
            'name' => $name,
            'url' => $url,
            'parent_id' => $parentId,
            'permission_id' => $permissionId,
            'icon' => $icon,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
