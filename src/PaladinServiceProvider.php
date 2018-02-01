<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午3:42
 */

namespace Charlestide\Paladin;

use Charlestide\Paladin\Command\Seed;
use Charlestide\Paladin\ModelFactories\FactoryManager;
use Charlestide\Paladin\Providers\AuthProvider;
use Charlestide\Paladin\Providers\ModelProvider;
use Charlestide\Paladin\Services\Paladin;
use Charlestide\Paladin\Storage\FileManager;
use Charlestide\Paladin\Storage\Persistent;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Charlestide\Paladin\Models\Menu;

class PaladinServiceProvider extends ServiceProvider
{

    const BASE_PATH = __DIR__.'/..';

    public function boot() {

        $this->loadModelFactories();

        $this->loadRoutesFrom( __DIR__.'/admin.php');

        $this->loadMigrationsFrom(self::BASE_PATH . '/database/migrations');

        $this->loadViewsFrom(self::BASE_PATH.'/views','paladin');

        $this->publishes([
            self::BASE_PATH.'/public' => public_path('paladin')
        ],'paladin-assets');

        $this->publishes([
            self::BASE_PATH.'/config/paladin.php' => config_path('paladin.php'),
            self::BASE_PATH.'/public' => public_path('paladin'),
        ],'paladin');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Seed::class
            ]);
        }
    }

    public function register()
    {
        $this->app->singleton(Persistent::class, function ($app) {
            return Persistent::instance();
        });

        $this->app->singleton(FileManager::class, function ($app) {
            return new FileManager(new FilesystemManager($app));
        });

        $this->app->singleton(Paladin::class,function($app) {
            return new Paladin();
        });


        $this->app->register(AuthProvider::class);

        $this->app->register(ModelProvider::class);
    }

    private function loadModelFactories() {
        FactoryManager::defineAll();
    }
}