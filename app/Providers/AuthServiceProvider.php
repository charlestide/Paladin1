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
        \App\Model\Admin::class => \App\Policies\AdminPolicy::class,
        \App\Model\Role::class => \App\Policies\RolePolicy::class,
        \App\Model\Permission::class => \App\Policies\PermissionPolicy::class,
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

//        Gate::define('admin.view','AdminPolicy@view');
//        dd(Gate::abilities());
//        if (Schema::hasTable('permissions')) {
//            foreach (Permission::all(['name','policy']) as $permission) {
//                Gate::define($permission->name, $permission->policy);
//            }
//        }
    }
}
