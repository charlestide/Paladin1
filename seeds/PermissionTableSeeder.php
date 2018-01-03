<?php

use Illuminate\Database\Seeder;
use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Services\AuthService;

class PermissionTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuthService::detectPermissions();

        Permission::create([
            'name' => 'system.index',
            'description' => '系统菜单'
        ])->save();

        Permission::create([
            'name' => 'devtool.index',
            'description' => '开发工具'
        ])->save();

        Permission::create([
            'name' => 'generator.index',
            'description' => '生成工具'
        ])->save();

        Permission::create([
            'name' => 'generator.crud',
            'description' => 'CRUD生成工具'
        ])->save();
    }
}
