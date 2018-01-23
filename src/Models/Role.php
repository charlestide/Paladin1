<?php

namespace Charlestide\Paladin\Models;

use App\Paladin\Generator\hasSchema;
use Illuminate\Database\Eloquent\Model;

/**
 * @角色
 * Class Role
 * @package Charlestide\Paladin\Models
 * @property int id 是ID
 */
class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id';
    
    protected $fillable = ['name','display_name','description'];


    public static function grouped() {
        $roles = static::all();
        $groups = [];
        foreach ($roles as $role) {
            $nameSplit = explode('.',$role->name);
            $groups[$nameSplit[0]][$role->name] = $role;
        }

        return $groups;
    }

    public function permissions() {
        return $this->morphToMany(Permission::class,'related','permission_relations');
    }

    public function admins() {
        return $this->belongsToMany(Role::class,'role_admin_relations');
    }
}
