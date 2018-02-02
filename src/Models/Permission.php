<?php

namespace Charlestide\Paladin\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * @name 权限
 * Class Permission
 * @package Charlestide\Paladin\Models
 */
class Permission extends SpatiePermission
{
    protected $table = 'permissions';

    protected $primaryKey = 'id';
    
    protected $fillable = ['name','display_name','description','category_id'];

    public function __construct(array $attributes = [])
    {
        $this->attributes['guard_name'] = config('paladin.guard','admin');
        parent::__construct($attributes);
    }

    public function category() {
        return $this->belongsTo(PermissionCategory::class,'category_id');
    }

    public function menus() {
        return $this->hasMany(Menu::class);
    }

    public function related() {
        return $this->belongsToMany(self::class,'permission_relations','permission_id','related_id');
    }
}
