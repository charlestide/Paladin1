<?php

namespace Charlestide\Paladin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @name 菜单
 * Class Menu
 * @package Charlestide\Paladin\Models
 */
class Menu extends Model
{
    protected $table = 'menu';

    protected $primaryKey = 'id';

//    protected $guarded = ['id'];

    protected $fillable = ['name','parent_id','url','parent_path','permission_id'];

    public static function wholeTree($parentId = 0) {
        $menus = self::where('parent_id',$parentId)
            ->with('permission')->get();
        foreach ($menus as $key => $menu) {
            $menu->permissionName = isset($menu->permission) ? $menu->permission->name : '';
            $menu->submenus = self::wholeTree($menu->id);
        }

        return $menus;
    }

    public function tree() {
        $children = $this->children();
        foreach ($children as $key => $child) {
            $children[$key]['children'] = $child->tree();
        }

        return $children;
    }

    public function children() {
        return $this->hasMany(Menu::class,'parent_id');
    }

    public function parent() {
        return $this->belongsTo(Menu::class,'parent_id');
    }

    public function permission() {
        return $this->belongsTo(Permission::class);
    }

    public function getParentsBuilder() {
        $dirtyParentPath = $this->getDirty()['parent_path'];
//        $this->finishSave()
        return $this->newQuery()->whereIn('id',explode('|',$this->parent_path));
    }


    /**
     * 将数据库的用|分隔的字符串，转成数组
     *
     * @param $value
     * @return array
     */
//    static public function allParentPermissionNames(array $permissionNames) {
//        static::permission()->whereIn('name',$permissionNames)
//    }

    /**
     * 将外部传来的数组，转成用|分隔的字符串，写入数据库
     *
     * @param $value
     * @return array
     */
//    public function setPathAttribute($value) {
//        if (is_array($value)) {
//            return implode('|', $value);
//        } else {
//            return $value;
//        }
//    }

}
