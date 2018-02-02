<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/2/1
 * Time: 下午12:45
 */

namespace Charlestide\Paladin\Seeder;

use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Models\PermissionCategory;

abstract class ModuleSeeder
{

    abstract public function run();

    /**
     * 创建权限
     *
     * @param string $name
     * @param int $categoryId
     * @param string|null $description
     * @return Permission
     */
    protected function createPermission(string $name,int $categoryId,string $description = null) {
        $permission = Permission::firstOrCreate([
            'name' => $name,
            'guard_name' => config('paladin.guard','admin'),
        ]);

        $permission->fill([
            'category_id' => $categoryId,
            'description' => $description
        ]);

        $permission->save();
        return $permission;
    }

    /**
     * 根据模块创建权限
     *
     * @param string $moduleName
     * @param array $actions
     * @param int $categoryId
     * @return Permission
     */
    protected function createPermissionsByModule(string $moduleName,array $actions,int $categoryId): Permission {
        $result = [];

        $systemMenu = $this->getSystemMenu();
        $systemPermission = $systemMenu->permission;
        foreach ($actions as $action) {
            $permission = $this->createPermission(
                __($action).' '. __($moduleName),
                $categoryId,
                __('the permission allows you to').' '.__($action).' '.__($moduleName));

            $permission->related()->sync($systemPermission->id);
            if ($action == 'browse') {
                $result = $permission;
            }
        }

        return $result;
    }

    /**
     * 创建权限和菜单
     *
     * @param string $moduleName
     * @return array
     */
    protected function createPermissionsAndMenu(string $moduleName) {
        $result = [];
        $actions = config('paladin.permissions.'.$moduleName);

        $category = PermissionCategory::firstOrCreate([
            'name' => __($moduleName).' '.__("'s permissions")
        ]);
        $browsePermission = $this->createPermissionsByModule($moduleName,$actions,$category->id);
        if ($browsePermission instanceof Permission) {
            $result['menu'] = $this->createMenu(
                __($moduleName), $browsePermission->id);
        }

        $result['permissions'] = $browsePermission;

        return $result;
    }

    /**
     * 创建一个菜单
     *
     * @param string $name
     * @param int $permissionId
     * @param string|null $url
     * @param int $parentId
     * @param string|null $icon
     * @return Menu
     */
    protected function createMenu(string $name,int $permissionId,string $url = null,
                                      int $parentId = 0,string $icon = null) {
        $menu = Menu::firstOrNew([
            'name' => $name,
        ]);

        $menu->fill([
            'url' => $url,
            'parent_id' => $parentId,
            'permission_id' => $permissionId,
            'icon' => $icon,
        ]);

        $menu->save();
        return $menu;
    }

    /**
     * 获得系统管理菜单
     *
     * @return Menu
     */
    protected function getSystemMenu() {
        $permission = $this->createPermission(__('system').__("'s permissions"),0);
        return $this->createMenu(
            __('system'),
            $permission->id,
            config('paladin.menus.system.url'),
            0,
            config('paladin.menus.system.icon','gear')
        );
    }
}