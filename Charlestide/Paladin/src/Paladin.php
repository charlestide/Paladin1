<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午3:43
 */

namespace Charlestide\Paladin;


use Illuminate\Support\Facades\Route;

class Paladin
{

    public function __construct()
    {
    }

    public static function routes()
    {
        include ('routes.php');
    }
}