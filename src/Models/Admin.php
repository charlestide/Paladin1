<?php

namespace Charlestide\Paladin\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Charlestide\Paladin\Models\Role;
use Illuminate\Support\Facades\Cache;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = ['password','remember_token'];

    public function isSuperAdmin() {
        return $this->id == 1;
    }

    /**
     * @param $password
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function permissions() {
        return $this->morphToMany(Permission::class,'related','permission_relations');
    }

    public function roles() {
        return $this->belongsToMany(Role::class,'role_admin_relations');
    }

    /**
     * 判断是否拥有某种权限
     * @param string $permissionId
     * @return bool
     */
    public function allow(int $permissionId): bool {

        if ($this->permissions()->where('permissions.id',$permissionId)->count()) {
            return true;
        }

        $hasCount = $this->roles()->withCount([
                    'permissions' => function(Builder $query) use ($permissionId) {
                        $query->where('permissions.id',$permissionId);
                    }
                ])
                ->pluck('permissions_count');

        return $hasCount->sum() > 0;
    }
}
