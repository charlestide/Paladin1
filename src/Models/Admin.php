<?php

namespace Charlestide\Paladin\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
     * @return \Illuminate\Support\Collection
     */
    public function allPermissions() {
        $self = $this;
        return Cache::remember("admin_{$this->id}_permissions",1,function () use ($self) {
            $adminPermissions = $self->permissions()->pluck('name');
            foreach ($self->roles as $role) {
                $rolePermissions = $role->permissions;
                $adminPermissions = $adminPermissions->merge($rolePermissions);
            }
            return $adminPermissions;
        });
    }

    public function allow($action) {
        return $this->allPermissions()->search($action);
    }
}
