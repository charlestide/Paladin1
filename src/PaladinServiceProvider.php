<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午3:42
 */

namespace Charlestide\Paladin;

use Charlestide\Paladin\Command\Install;
use Charlestide\Paladin\Command\Seed;
use Charlestide\Paladin\Command\SuperAdmin;
use Charlestide\Paladin\ModelFactories\FactoryManager;
use Charlestide\Paladin\Providers\AuthProvider;
use Charlestide\Paladin\Providers\ModelProvider;
use Charlestide\Paladin\Services\Paladin;
use Charlestide\Paladin\Storage\FileManager;
use Charlestide\Paladin\Storage\Persistent;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;

class PaladinServiceProvider extends ServiceProvider
{

    const BASE_PATH = __DIR__.'/..';

    public function boot() {

        $this->loadModelFactories();

        $this->loadRoutesFrom( __DIR__.'/admin.php');

        $this->loadViewsFrom(self::BASE_PATH.'/views','paladin');

        $this->publishes([
            self::BASE_PATH.'/public/images/logo.png' => public_path('images/logo.png'),
            self::BASE_PATH.'/assets/js/admin.js' => resource_path('assets/js/admin.js'),
            self::BASE_PATH.'/assets/sass/admin.scss' => resource_path('assets/sass/admin.scss'),
            self::BASE_PATH.'/assets/sass/bootstrap4.scss' => resource_path('assets/sass/bootstrap4.scss'),
            self::BASE_PATH.'/assets/sass/element.scss' => resource_path('assets/sass/element.scss'),
            self::BASE_PATH.'/.babelrc' => base_path('.babelrc'),
            self::BASE_PATH.'/webpack.mix.js' => base_path('webpack.mix.js'),
            self::BASE_PATH.'/template/Handler.php' => app_path('Exceptions/Handler.php'),
        ],'assets');

        $this->publishes([
            self::BASE_PATH.'/config/paladin.php' => config_path('paladin.php'),
            self::BASE_PATH.'/config/permission.php' => config_path('permission.php'),
            self::BASE_PATH.'/config/auth.php' => config_path('auth.php'),
        ],'config');

        $timestamp = date('Y_m_d_His', strtotime('+1 min'));

        $this->publishes([
            self::BASE_PATH.'/database/migrations/create_paladin_tables.php'
                => database_path("migrations/{$timestamp}_create_paladin_tables.php")
        ],'migrations');

        $this->publishes([
            self::BASE_PATH.'/lang' => resource_path('lang')
        ],'lang');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Seed::class,
                SuperAdmin::class,
                Install::class
            ]);
        }

        Passport::routes();
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

        $this->app->register(PassportServiceProvider::class);

        $this->app->register(AuthProvider::class);

        $this->app->register(ModelProvider::class);
    }

    private function loadModelFactories() {
        FactoryManager::defineAll();
    }
}