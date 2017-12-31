<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午6:00
 */

namespace Charlestide\Paladin\Providers;

use Charlestide\Paladin\Middlewares\AutoAuth;
use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Models\Role;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteProvider extends ServiceProvider
{

    protected $namespace = 'Charlestide\Paladin\Controllers';

    protected $middleware = ['paladin'];

    protected $middlewareGroups = [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            AutoAuth::class
    ];

    public function boot()
    {
        parent::boot();

        Route::model('admin',Admin::class);
        Route::model('role',Role::class);
        Route::middlewareGroup('paladin',[AutoAuth::class]);

    }

    public function map() {
//        Route::namespace($this->namespace)
//            ->middleware('paladin')
//            ->group(function () {
//                $this->mapAuths();
//                $this->mapWithAuth();
//            });
    }

    public function mapAuths() {
        Route::get('login','LoginController@showLoginForm')->name('login');
        Route::post('login','LoginController@login');
        Route::get('logout', 'LoginController@logout')->name('logout');
    }

    public function mapWithAuth() {
        Route::group(['middleware' => 'auth'],function () {
            $this->mapLayout();
            $this->mapGenerator();
            $this->mapSystem();
        });
    }

    public function mapLayout() {
        Route::get('dashboard', 'DashBoardController@index');
    }

    protected function mapGenerator() {
        //Generator
        Route::namespace('Generator')->prefix('generator/crud')->group(function (){
            Route::get('','CrudController@show');
            Route::get('model','CrudController@model');
            Route::post('run','CrudController@run');
        });
    }

    protected function mapSystem() {
        //Admin
        Route::match(['get','post'],'/admin/{admin}/assign','AdminController@assign');
        Route::match(['get', 'post'],'admin/{admin}/role','AdminController@role');
        Route::resource('admin', 'AdminController');

        //Role
        Route::match(['get','post'],'/role/{role}/assign','RoleController@assign');
        Route::resource('role','RoleController');

        //Permission
        Route::resource('permission','PermissionController');

        //Menu
        Route::get('menu/create/{parent?}','MenuController@create');
        Route::get('menu/{menu}/delete','MenuController@destroy');
        Route::resource('menu','MenuController',['except' => ['create','delete']]);
    }



}