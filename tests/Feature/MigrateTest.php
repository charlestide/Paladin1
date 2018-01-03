<?php

namespace Charlestide\Paladin\Tests\Feature;

use Charlestide\Paladin\Tests\Base\Base;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MigrateTest extends Base
{
    public function setUp()
    {
        parent::setUp();
        $this->artisan('migrate',[
            '--database' => 'testbench',
        ]);

        $this->runSeeds();
    }

    public function testAdmin()
    {
        $this->assertDatabaseHas('admins',[
            'id' => 1,
            'name' => 'admin',
        ]);
        $admin = DB::table('admins')->where('id',1)->first();
        $this->assertTrue(
            Hash::check('123456',$admin->password)
        );
    }

    public function testRoles() {

        $this->assertTrue(
            Schema::hasTable('roles')
        );
        $this->assertTrue(
            Schema::hasTable('role_admin_relations')
        );
    }

    public function testPermissions() {

        $this->assertTrue(
            Schema::hasTable('permissions')
        );
        $this->assertTrue(
            Schema::hasTable('permission_relations')
        );
    }

    public function testMenus() {
        $this->assertTrue(
            Schema::hasTable('menu')
        );
    }

    protected function tearDown()
    {
        $this->artisan('migrate:reset');
    }
}
