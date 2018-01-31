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

    protected $fillable = ['name','parent_id','url','permission_id','parent_path'];

    protected $appends = ['parent_path','parent'];

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

    public function related() {
        return $this->belongsToMany(self::class,
            'menu_relations',
            'menu_id',
            'related_id',
            'id',
            'id'
        );
    }

    /**
     * 权限ID的修改器
     *
     * 如果权限ID不存在，则创建一个新的权限
     *
     * @param $value
     */
    public function setPermissionIdAttribute($value) {
        if (empty($value)) {
            $permission = Permission::firstOrCreate([
                'name' => $this->name,
                'description' => '能看到'.$this->name.'菜单',
                'guard_name' => 'admin'
            ]);
            $value = $permission->id;
        }
        return $this->attributes['permission_id'] = $value;
    }

    /**
     * 父路径的访问器
     *
     * @return mixed
     */
    public function getParentPathAttribute() {
        return $this->related->pluck('id');
    }

    /**
     * 父路径的修改器
     *
     * @param $value
     */
    public function setParentPathAttribute($value) {
        $this->related()->sync($value);
    }

    /**
     * 父菜单的访问器
     *
     * @return mixed
     */
    public function getParentAttribute() {
        return $this->attributes['parent'] = $this->related->last();
    }
}
