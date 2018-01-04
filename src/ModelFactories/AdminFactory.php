<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午12:54
 */

namespace Charlestide\Paladin\ModelFactories;

use Charlestide\Paladin\Models\Admin;
use Faker\Generator as Faker;

class AdminFactory extends Factory
{

    public function define()
    {
        $this->factory->define(Admin::class, function (Faker $faker) {
            static $password;

            return [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => $password ?: bcrypt('123456'),
                'remember_token' => str_random(10),
                'created_at' => date('Y-m-d')
            ];
        });

        $this->factory->state(Admin::class,'fake',function(Faker $faker){
            return [
                'id' => $faker->unique()->numberBetween(100,200)
            ];
        });
    }
}