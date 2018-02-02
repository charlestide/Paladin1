<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/2/1
 * Time: 下午12:59
 */

namespace Charlestide\Paladin\Seeder;


use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Models\Permission;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends ModuleSeeder
{
    public function run()
    {


    }

    /**
     * @param string $email
     * @param string $password
     * @return Admin
     */
    public function createSuperAdmin($email = 'admin@admin.com',$password = '123456') {
        $admin = Admin::firstOrCreate([
            'name' => str_before($email,'@'),
            'email' => $email,
            'password' => $password
        ]);

        $permissionNames = Permission::pluck('name');

        $admin->syncPermissions($permissionNames);

        return $admin;
    }

}