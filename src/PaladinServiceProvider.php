<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午3:42
 */

namespace Charlestide\Paladin;

use Charlestide\Paladin\Generator\Crud\CrudGenerator;
use Charlestide\Paladin\Providers\AuthProvider;
use Charlestide\Paladin\Providers\RouteProvider;
use Charlestide\Paladin\Storage\FileManager;
use Charlestide\Paladin\Storage\Persistent;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\ServiceProvider;

class PaladinServiceProvider extends ServiceProvider
{

    public function boot() {

        $this->publishes([
            __DIR__.'/../config/paladin.php' => config_path('paladin.php')
        ],'config');

        $this->loadRoutesFrom( __DIR__.'/routes.php');

        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->loadViewsFrom(__DIR__.'/../views','paladin');

        $this->publishes([
            __DIR__.'/../seeds' => database_path('seeds/vendor/paladin')
        ],'seeder');


        $this->publishes([
            __DIR__.'/../public' => public_path('paladin')
        ],'assets');

    }

    public function register()
    {
        $this->app->singleton(Persistent::class, function ($app) {
            return Persistent::instance();
        });

        $this->app->singleton(FileManager::class, function ($app) {
            return new FileManager(new FilesystemManager($app));
        });


        $this->app->register(AuthProvider::class);
    }
}