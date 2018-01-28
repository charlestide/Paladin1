<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/1/25
 * Time: 下午4:05
 */

namespace Charlestide\Paladin\Providers;


use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Observers\MenuObserver;
use Illuminate\Support\ServiceProvider;

class ModelProvider extends ServiceProvider
{

    public function boot() {
        Menu::observe(MenuObserver::class);
    }
}