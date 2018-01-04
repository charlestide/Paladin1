<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午11:12
 */

namespace Charlestide\Paladin\Policies;

use Charlestide\Paladin\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class CrudPolicy extends Policy
{
    /**
     * @name 查看
     * @summary 拥有这个权限的用户，可以查看关联的对象
     * @param  Admin $user
     * @param  Model $model
     * @return mixed
     */
    public function view(Admin $user, Model $model)
    {
        return $this->can('view',$user,$model);
    }

    /**
     * @name 创建
     * @summary 拥有这个权限的用户，可以创建关联的对象
     *
     * @param  Admin $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        return $this->can('create',$user);
    }

    /**
     * @name 修改
     * @summary 拥有这个权限的用户，可以修改关联的对象
     *
     * @param  Admin $user
     * @param  Model  $model
     * @return mixed
     */
    public function update(Admin $user, Model $model)
    {
        return $this->can('update',$user,$model);
    }

    /**
     * @name 删除
     * @summary 拥有这个权限的用户，可以删除关联的对象
     *
     * @param  Admin $user
     * @param  Model  $model
     * @return mixed
     */
    public function delete(Admin $user, Model $model)
    {
        return $this->can('delete',$user,$model);
    }

    /**
     * @name 浏览
     * @summary 拥有这个权限的用户，可以浏览关联的对象
     * @param Admin $user
     * @return bool
     */
    public function index(Admin $user) {
        return $this->can('index',$user);
    }

}