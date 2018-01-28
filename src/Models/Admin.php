<?php

namespace Charlestide\Paladin\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * 管理员的类
 *
 * @displayName 管理员
 * @package Charlestide\Paladin\Models
 *
 * @property int $id 管理员ID
 * @property string $name 管理员名称
 * @property string $email 管理员Email
 * @property string $password 管理员密码
 * @property string $remember_token 记住用户的token
 * @property \Carbon\Carbon $created_at 创建于
 * @property \Carbon\Carbon $updated_at 更新于
 */
class Admin extends Authenticatable
{
    use Notifiable,HasApiTokens, HasRoles;

    protected $guard_name = 'admin';

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

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
//     */
//    public function permissions():MorphToMany {
//        return $this->morphToMany(Permission::class,'related','permission_relations');
//    }
//
//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
//     */
//    public function roles(): BelongsToMany {
//        return $this->belongsToMany(Role::class,'role_admin_relations');
//    }

//    /**
//     * 按权限action和object判断，管理员是否有这种权限
//     *
//     * @param string $permissionAction
//     * @param string $class
//     * @return bool
//     */
//    public function hasPermissionByAction(string $permissionAction,string $class): bool {
//        $permissionId = Permission::where([
//            'action'=> $permissionAction,
//            'object' => $class
//        ])->value('id');
//        return $permissionId and $this->hasPermissionById($permissionId);
//    }
//
//    /**
//     * 按权限ID判断，管理员是否有这种权限
//     *
//     * @param int $permissionId
//     * @return bool
//     */
//    public function hasPermissionById(int $permissionId): bool {
//
//        if ($this->permissions()->where('permissions.id',$permissionId)->count()) {
//            return true;
//        }
//
//        $hasCount = $this->roles()->withCount([
//                    'permissions' => function(Builder $query) use ($permissionId) {
//                        $query->where('permissions.id',$permissionId);
//                    }
//                ])
//                ->pluck('permissions_count');
//
//        return $hasCount->sum() > 0;
//    }
}
