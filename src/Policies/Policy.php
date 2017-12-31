<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午10:46
 */

namespace Charlestide\Paladin\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Charlestide\Paladin\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Charlestide\Paladin\Services\AuthService;
use Illuminate\Support\Facades\Cache;


class Policy
{
    use HandlesAuthorization;


    protected $hasOnly = true;

    protected $userField = 'id';

    protected $modelField = 'admin_id';

    /**
     * @param Admin $user
     * @return bool
     */
    public function before(Admin $user) {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * @param $permissionName
     * @param Admin $user
     * @param Model|null $model
     * @return bool
     */
    protected function can($permissionName,Admin $user, Model $model = null) {

        if ($model == null) {
            $modelClass = AuthService::getModelClassByPolicy(static::class);
        } else {
            $modelClass = get_class($model);
        }
        $permissionName = camel_case(class_basename($modelClass)) . '.' . $permissionName;

        $permissions = Cache::remember('all_permisstions_for_admin_'.$user->id,1,function () use ($user){
            return $user->allPermissions()->pluck('name','id')->toArray();
        });

        if (in_array($permissionName,$permissions)) {
            if ($this->hasOnly) {
                return true;
            } else {
                $userField = $this->userField;
                $modelField = $this->modelField;
                return $user->$userField == $model->$modelField;
            }
        }
    }
}