<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/2/1
 * Time: 下午1:33
 */

namespace Charlestide\Paladin\Command;

use Charlestide\Paladin\Seeder\SuperAdminSeeder;
use Illuminate\Console\Command;

class SuperAdmin extends Command
{

    protected $signature = 'paladin:superadmin {email=admin@admin.com} {password=123456}';

    protected $description = 'create an super admin or update permissions for it';

    public function handle() {
        $adminSeeder = new SuperAdminSeeder();
        $admin = $adminSeeder->createSuperAdmin(
            $this->argument('email'),
            $this->argument('password')
        );

        if ($admin->id) {
            $this->info('Super Admin has been created');
            $this->warn('Name: ' . $admin->name);
            $this->warn('Email: ' . $admin->email);
        } else {
            $this->error('Error to create Super Admin');
        }
    }
}