<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 下午11:53
 */

namespace Charlestide\Paladin\Policies;


use Charlestide\Paladin\Models\Admin;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class DoPolicy extends Policy
{


    /**
     * @param string $action
     * @param Admin $admin
     * @param $object
     * @return bool
     */
    public function _has(string $action, Admin $admin, $object): bool {
        return $admin->hasPermissionByAction($action,is_object($object) ? get_class($object) : $object);
    }
}