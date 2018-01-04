<?php

use Illuminate\Database\Seeder;
use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Services\AuthService;

class PermissionTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuthService::detectPermissions();
    }
}
