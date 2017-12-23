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

    /**
     * @param $password
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }
}
