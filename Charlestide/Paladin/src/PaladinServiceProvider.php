<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午3:42
 */

namespace Charlestide\Paladin;

use Charlestide\Paladin\Providers\RouteProvider;
use Illuminate\Support\ServiceProvider;

class PaladinServiceProvider extends ServiceProvider
{

    public function boot() {
    }

    public function register()
    {
        $this->app->singleton(Paladin::class, function ($app) {
            return new Paladin();
        });

        $this->app->register(RouteProvider::class);
    }
}