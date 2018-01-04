<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午11:32
 */

namespace Charlestide\Paladin\ModelFactories;

use Charlestide\Paladin\Models\Menu;
use Faker\Generator as Faker;


class MenuFactory extends Factory
{
    function define()
    {
        $this->factory->define(Menu::class, function (Faker $faker) {

            return [
                'name' => $faker->name,
                'url' => $faker->url,
                'parent_id' => $faker->numberBetween(0,5),
                'permission_id' => 0,
                'created_at' => date('Y-m-d')
            ];
        });
    }

}