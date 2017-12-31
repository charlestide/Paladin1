<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午7:56
 */

namespace Charlestide\Paladin\Providers;


use Charlestide\Paladin\Policies\CrudPolicy;
use Charlestide\Paladin\Services\AuthService;
use Charlestide\Paladin\Storage\Persistent;
use Illuminate\Support\Facades\Gate;
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
        $this->loadCrudPolicy();
        $this->registerPolicies();
    }

    public function register()
    {
        $this->app->singleton(AuthService::class,function($app) {
           return new AuthService();
        });
    }


    public function loadCrudPolicy() {
        $storage = app(Persistent::class);
        if (isset($storage->crudModels) and is_array($storage->crudModels)) {
            foreach ($storage->crudModels as $modelName) {
                if (!Gate::getPolicyFor($modelName) and !isset($this->policies[$modelName])) {
                    $this->policies[$modelName] = CrudPolicy::class;
                }
            }
        }
    }
}