<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

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
        return $this->morphedByMany('App\Model\Role','related','permission_relations');
    }

    public function admins() {
        return $this->morphedByMany('App\Model\Admin','related','permission_relations');
    }
}
