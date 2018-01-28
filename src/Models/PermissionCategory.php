<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/1/24
 * Time: 下午10:03
 */

namespace Charlestide\Paladin\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionCategory extends Model
{

    protected $table = 'permission_category';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function permissions() {
        return $this->hasMany(Permission::class);
    }
}