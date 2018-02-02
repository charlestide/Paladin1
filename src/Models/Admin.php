<?php

namespace Charlestide\Paladin\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
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

    protected $table = 'admins';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = ['password','remember_token'];

    /**
     * @param $password
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    protected function getGuardNames(): Collection
    {
        $guardNames = collect();
        $guardNames->push(config('paladin.guard','admin'));

        $guardNames->merge(collect(config('auth.guards'))
            ->map(function ($guard) {
                return config("auth.providers.{$guard['provider']}.model");
            })
            ->filter(function ($model) {
                return get_class($this) === $model;
            })
            ->keys());

        return $guardNames;
    }
}
