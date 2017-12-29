<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{

    private $crudPermission = [
        'create' => '创建',
        'update' => '更新',
        'delete' => '删除',
        'view'   => '查看',
        'list'   => '管理'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCrud('admin','管理员');
        $this->createCrud('permission','权限');
        $this->createCrud('role','角色');
    }

    private function createCrud($modelName,$displayName = null) {
        $displayName = $displayName ?: $modelName;
        foreach ($this->crudPermission as $permimissName => $permissionDisplayName) {
            DB::table('permissions')->insert([
                'name' => "$modelName.$permimissName",
                'policy' => "\App\Policys\\".studly_case($modelName).'Policy@'.$permimissName,
                'description' => "允许 $permissionDisplayName $displayName",
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
