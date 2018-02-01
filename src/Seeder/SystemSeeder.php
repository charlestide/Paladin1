<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/2/1
 * Time: 下午12:59
 */

namespace Charlestide\Paladin\Seeder;


class SystemSeeder extends ModuleSeeder
{
    public function run()
    {
        $systemMenu = $this->getSystemMenu();

        foreach (config('paladin.modules') as $moduleName => $actions) {
            $result = $this->createPermissionsAndMenu($moduleName);
            $menu = $result['menu'];
            $menu->parent_id = $systemMenu->id;
            $menu->save();
        }
    }


}