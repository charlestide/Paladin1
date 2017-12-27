<?php

namespace App\Providers;

use App\Model\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model\Admin' => 'App\Policies\AdminPolicy',
        'App\Model\Role' => 'App\Policies\RolePolicy',
        'App\Model\Rermission' => 'App\Policies\PermissionPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerGates();
    }

    public function registerGates() {

        if (Schema::hasTable('permissions')) {
            foreach (Permission::all() as $permission) {
                Gate::define($permission->name, $permission->policy);
            }
        }
    }
}
