<?php

use Illuminate\Database\Seeder;
use Charlestide\Paladin\Services\AuthService;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuthService::detectPermissions();

        $systemId = $this->createMenu('系统管理','',0,'gear');
        $this->createMenu('管理员','/admin',$systemId,'users');
        $this->createMenu('角色','/role',$systemId,'user');
        $this->createMenu('权限','/permission',$systemId,'user-secret');
        $this->createMenu('菜单管理','/menu',$systemId,'list-ul');

        $devToolId = $this->createMenu('开发工具','',0,'magic');
        $generatorId = $this->createMenu('生成工具','',$devToolId,'bolt');
        $this->createMenu('CRUD','/generator/crud',$generatorId);
    }

    public function createMenu($name,$url,$parentId = 0,$icon = null) {
        return DB::table('menu')->insertGetId([
            'name' => $name,
            'url' => $url,
            'parent_id' => $parentId,
            'icon' => $icon,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
