<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/2/1
 * Time: 下午1:48
 */

namespace Charlestide\Paladin\Services;


class Paladin
{

    /**
     * @return int
     */
    public static function version(): int {
        return intval(str_replace('.','',config('paladin.version',1)));
    }
}