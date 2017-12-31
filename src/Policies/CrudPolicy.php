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
     * Determine whether the user can view the menu.
     *
     * @param  Admin $user
     * @param  Model $model
     * @return mixed
     */
    public function view(Admin $user, Model $model)
    {
        return $this->can('view',$user,$model);
    }

    /**
     * Determine whether the user can create menus.
     *
     * @param  Admin $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        return $this->can('create',$user);
    }

    /**
     * Determine whether the user can update the menu.
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
     * Determine whether the user can delete the menu.
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
     * @param Admin $user
     * @return bool
     */
    public function index(Admin $user) {
        return $this->can('index',$user);
    }

}