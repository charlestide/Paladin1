<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午11:35
 */

namespace Charlestide\Paladin\ModelFactories;

use Charlestide\Paladin\Models\Role;
use Faker\Generator as Faker;

class RoleFactory extends Factory
{

    function define()
    {
        $this->factory->define(Role::class, function (Faker $faker) {

            return [
                'name' => $faker->name,
                'display_name' => $faker->name,
                'created_at' => date('Y-m-d')
            ];
        });
    }
}