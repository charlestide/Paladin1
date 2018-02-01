<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午2:03
 */

namespace Charlestide\Paladin\Tests\Base;


trait Migrated
{


    protected function setUp() {
        parent::setUp();

        $this->runMigrate();
//        $this->runSeeder();
    }

    protected function tearDown()
    {
        $this->rollbackMigrate();
        parent::tearDown();
    }

    protected function runMigrate()
    {
        $this->artisan('migrate',[
            '--database' => 'testbench',
        ]);
    }

    protected function runSeeder(): void
    {
        $this->artisan('db:seed',[
            '--database' => 'testbench',
        ]);
    }

    protected function rollbackMigrate(): void {
        $this->artisan('migrate:reset',['--database' => 'testbench']);

    }

}