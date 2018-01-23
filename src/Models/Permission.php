<?php

namespace Charlestide\Paladin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @name 权限
 * Class Permission
 * @package Charlestide\Paladin\Models
 */
class Permission extends Model
{
    protected $table = 'permissions';

    protected $primaryKey = 'id';
    
    protected $fillable = ['name','display_name','description'];

    public static function grouped() {
        $permissions = static::all();
        $groups = [];
        foreach ($permissions as $permission) {
            $nameSplit = explode('.',$permission->name);
            $groups[$nameSplit[0]][$permission->name] = $permission;
        }

        return $groups;
    }

    public function roles() {
        return $this->morphedByMany(Role::class,'related','permission_relations');
    }

    public function admins() {
        return $this->morphedByMany(Admin::class,'related','permission_relations');
    }

    public function menus() {
        return $this->hasMany(Menu::class);
    }
}
