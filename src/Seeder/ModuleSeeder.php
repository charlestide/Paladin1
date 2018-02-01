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
     * @param string $guardName
     * @return Permission
     */
    protected function createPermission(string $name,int $categoryId,string $description = null,string $guardName = 'admin') {
        return Permission::firstOrCreate([
            'name' => $name,
            'category_id' => $categoryId,
            'guard_name' => $guardName,
            'description' => $description
        ]);
    }

    /**
     * 根据模块创建权限
     *
     * @param string $moduleName
     * @param array $actions
     * @param int $categoryId
     * @return [Permission]
     */
    protected function createPermissionsByModule(string $moduleName,array $actions,int $categoryId): array {
        $result = [];

        $systemMenu = $this->getSystemMenu();
        $systemPermission = $systemMenu->permission;
        foreach ($actions as $action) {
            $permission = $this->createPermission(
                __($action).' '. __($moduleName),
                $categoryId,
                __('the permission allows you to').' '.__($action).' '.__($moduleName));

            $permission->related()->sync($systemPermission->id);
            $result[$action] = $permission;
        }

        return $result;
    }

    /**
     * 创建权限和菜单
     *
     * @param string $moduleName
     * @return array
     */
    protected function createPermissionsAndMenu(string $moduleName,$relatedId) {
        $result = [];
        $actions = config('paladin.modules.'.$moduleName);

        $category = PermissionCategory::firstOrCreate(__('permissions of').' '.__($moduleName));
        $actionPermissions = $this->createPermissionsByModule($moduleName,$actions,$category->id);
        if (isset($actionPermissions[__('browse')])) {
            $result['menu'] = $this->createMenu(__($moduleName), ($actionPermissions[__('browse')])->id);
        }

        $result['permissions'] = $actionPermissions;

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
        return Menu::firstOrCreate([
            'name' => $name,
            'url' => $url,
            'parent_id' => $parentId,
            'permission_id' => $permissionId,
            'icon' => $icon,
        ]);
    }

    /**
     * 获得系统管理菜单
     *
     * @return Menu
     */
    protected function getSystemMenu() {
        $permission = $this->createPermission(__('permissions of').' '.__('System Management'),0);
        return $this->createMenu(__('System Management'),$permission->id);
    }
}