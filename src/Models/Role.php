<?php

namespace Charlestide\Paladin\Models;

use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @角色
 * Class Role
 * @package Charlestide\Paladin\Models
 * @property int id 是ID
 */
class Role extends SpatieRole
{
//    protected $table = 'my_roles';

    protected $primaryKey = 'id';
    
    protected $fillable = ['name','display_name','description'];

    protected $attributes = ['guard_name' => 'admin'];

    protected $guard_name = 'admin';


    public static function grouped() {
        $roles = static::all();
        $groups = [];
        foreach ($roles as $role) {
            $nameSplit = explode('.',$role->name);
            $groups[$nameSplit[0]][$role->name] = $role;
        }

        return $groups;
    }

//    public function permissions() {
//        return $this->morphToMany(Permission::class,'related','permission_relations');
//    }
//
//    public function admins() {
//        return $this->belongsToMany(Role::class,'role_admin_relations');
//    }
}
