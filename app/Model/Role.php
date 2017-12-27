<?php

namespace App\Model;

use App\Paladin\Generator\hasSchema;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id';
    
    protected $fillable = ['name','display_name','description'];


    public function permissions() {
        return $this->morphToMany('App\Model\Permission','related','permission_relations');
    }
}
