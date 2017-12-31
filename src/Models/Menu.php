<?php

namespace Charlestide\Paladin\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public static function wholeTree($parentId = 0) {
        $menus = self::where('parent_id',$parentId);
        foreach ($menus as $key => $menu) {
            $menu->children();
        }
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

}
