<?php

namespace Charlestide\Paladin\Tests\Base;


use Charlestide\Paladin\PaladinServiceProvider;
use Charlestide\Paladin\Providers\TestProvider;
use Orchestra\Testbench\TestCase;

class Base extends TestCase
{

    protected function setUp()
    {
        parent::setUp();
    }

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
            'database' => 'testbench',
            'username' => 'root',
            'password' => ''
        ]);
    }

    /**
     *
     * @param $object
     * @param string $methodName
     * @param null $parameters
     * @return mixed
     */
    protected function runInaccessableMethod($object,string $methodName,$parameters = null) {
        $method = new \ReflectionMethod(get_class($object),$methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object,$parameters);
    }
}
