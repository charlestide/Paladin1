<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2018/1/4
 * Time: 上午1:04
 */

namespace Charlestide\Paladin\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

class TestProvider extends ServiceProvider
{

    public function boot() {

        $this->requireSeeder();
    }

    public function register() {

    }

    private function requireSeeder()
    {
        require_once  $this->app->databasePath('seeds').'/DatabaseSeeder.php';
    }


}