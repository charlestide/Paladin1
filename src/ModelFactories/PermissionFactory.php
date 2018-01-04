<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午11:33
 */

namespace Charlestide\Paladin\ModelFactories;

use Charlestide\Paladin\Models\Permission;
use Faker\Generator as Faker;


class PermissionFactory extends Factory
{
    function define()
    {
        $this->factory->define(Permission::class, function (Faker $faker) {
            return [
                'name' => $faker->name,
                'policy' => $faker->name,
                'created_at' => date('Y-m-d')
            ];
        });
    }
}