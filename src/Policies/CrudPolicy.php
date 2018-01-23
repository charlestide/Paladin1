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
    protected $allowActions = ['view','browse','create','update','delete'];
}