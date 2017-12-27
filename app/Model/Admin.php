<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
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
        return $this->morphToMany('App\Model\Permission','related','permission_relations');
    }
}
