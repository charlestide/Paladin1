<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/1/25
 * Time: 下午3:31
 */

namespace Charlestide\Paladin\Observers;

use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Models\Permission;

class MenuObserver
{
    /**
     * 在save之前，如果menu更换了permission，则去除原来permission的关联
     *
     * @param Menu $menu
     */
    public function saving(Menu $menu) {

        //如果menu更换了permisson
        if ($menu->isDirty('permission_id')) {
            //获得原来的permission
            $dirtyPermissionId = $menu->getDirty()['permission_id'];
            $dirtyPermission = Permission::find($dirtyPermissionId);

            //获得parent_path
            if ($menu->isDirty('parent_path')) {
                $parentPath = $menu->getDirty()['parent_path'];
            } else {
                $parentPath = $menu->parent_path;
            }

            //获得原来的permissionId数组
            $dirtyParentIds = explode('|',$parentPath);
            $dirtyPermissionIds = Menu::whereIn('id',$dirtyParentIds)->pluck('permission_id');

            //将原来的permission去除原来的关联
            $dirtyPermission->related()->detach($dirtyPermissionIds);
        }
    }

    /**
     * 在保存之后，对关联的permission，增加父menu的permssion关联
     *
     * @param Menu $menu
     */
    public function saved(Menu $menu) {
        $parentMenuIds = explode('|',$menu->parent_path);
        $permissionIds = Menu::whereIn('id',$parentMenuIds)->pluck('permission_id');
        $menu->permission->related()->sync($permissionIds);
    }
}