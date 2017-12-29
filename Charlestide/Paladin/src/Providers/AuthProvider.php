<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午7:56
 */

namespace Charlestide\Paladin\Providers;


use Charlestide\Paladin\Services\AuthService;
use function foo\func;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthProvider extends ServiceProvider
{

    protected $policies = [
        \Charlestide\Paladin\Models\Admin::class => \Charlestide\Paladin\Policies\AdminPolicy::class,
        \Charlestide\Paladin\Models\Role::class => \Charlestide\Paladin\Policies\RolePolicy::class,
        \Charlestide\Paladin\Models\Permission::class => \Charlestide\Paladin\Policies\PermissionPolicy::class,
        \Charlestide\Paladin\Models\Menu::class => \Charlestide\Paladin\Policies\MenuPolicy::class,
    ];


    public function boot() {
        $this->registerPolicies();

//        Gate::define('menu.index')

    }

    public function register()
    {
        $this->app->singleton(AuthService::class,function($app) {
           return new AuthService();
        });
    }
}