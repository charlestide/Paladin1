<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午10:46
 */

namespace Charlestide\Paladin\Policies;

use Charlestide\Paladin\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;
use Charlestide\Paladin\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Charlestide\Paladin\Services\AuthService;


class Policy
{
    use HandlesAuthorization;

    /**
     * 是否只判断权限，
     * @var bool
     */
    protected $hasOnly = true;

    /**
     * 管理员与对象关联的外键
     * @var string
     */
    protected $userField = 'id';

    /**
     * 对象与管理员关联的外键
     * @var string
     */
    protected $modelField = 'admin_id';

    /**
     * 如果设置此成员，当调用can方法时，如果没有指定object，则什么此类名
     * @var string
     */
    protected $defaultObjectClass;

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
     * @var array 允许的方法
     */
    protected $allowActions = [];

    /**
     * @var array 禁止的方法
     */
    protected $guardActions = [];


    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        if ($name != 'isApproved') {
            if (count($this->guardActions) and in_array($name, $this->guardActions)) {
                throw new \BadMethodCallException();
            }

            if (count($this->allowActions) and !in_array($name,$this->allowActions)) {
                throw new \BadMethodCallException();
            }
            array_unshift($arguments, $name);
        }

        return call_user_func_array([$this, 'isApproved'], $arguments);
    }

    /**
     * 判断当前管理员是否可以做这个操作
     *
     * @param string $action
     * @param Admin $user
     * @param $model
     * @return bool
     */
    public function isApproved(string $action, Admin $user, $model, bool $hasOnly = null):bool {

        $modelClass = is_object($model) ? get_class($model) : $model;

        if ($user->hasPermissionByAction($action,$modelClass)) {
            if ($hasOnly or $this->hasOnly) {
                return true;
            } else {
                $userField = $this->userField;
                $modelField = $this->modelField;
                if (is_object($model)) {
                    return $user->$userField == $model->$modelField;
                } else {
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    /**
     * @param array $allowActions
     */
    public function setAllowActions(array $allowActions): void
    {
        $this->allowActions = $allowActions;
    }


}