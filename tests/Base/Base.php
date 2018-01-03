<?php

namespace Charlestide\Paladin\Tests\Base;


use Charlestide\Paladin\PaladinServiceProvider;
use Orchestra\Testbench\TestCase;

class Base extends TestCase
{

    protected $seeds = [
        'AdminsTableSeeder',
        'MenuTableSeeder',
        'RoleTableSeeder',
        'PermissionTableSeeder',
        'PermissionRelationsTableSeeder',
    ];

    protected function getPackageProviders($application)
    {
        return [
            PaladinServiceProvider::class,

        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config'] -> set('database.default','testbench');
        $app['config'] -> set('database.connections.testbench',[
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => 'test',
            'username' => 'root',
            'password' => ''
        ]);
    }

    /**
     * 运行$this->seeds中的seed
     */
    protected function runSeeds() {
//        $oldIncludePath = get_include_path();
//        set_include_path(__DIR__.'/../../seeds/');

        foreach ($this->seeds as $seed) {
            require_once(__DIR__.'/../../seeds/'.$seed .'.php');
            (new $seed)->run();
        }

//        set_include_path($oldIncludePath);
    }
}
