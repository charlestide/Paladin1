<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午4:29
 */


Route::aliasMiddleware('autoauth','Charlestide\Paladin\Middlewares\AutoAuth');
Route::middlewareGroup('paladin',[
    'Charlestide\Paladin\Middlewares\AutoAuth',
//    \App\Http\Middleware\EncryptCookies::class,
//    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
//    \Illuminate\Session\Middleware\StartSession::class,
//    \Illuminate\Session\Middleware\AuthenticateSession::class,
//    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//    \App\Http\Middleware\VerifyCsrfToken::class,
//    \Illuminate\Routing\Middleware\SubstituteBindings::class,
]);

Route::aliasMiddleware('auth-admin',\Charlestide\Paladin\Middlewares\AuthenticateAdminApi::class);

Route::namespace('Charlestide\Paladin\Controllers')
//    ->middleware('api')
    ->group(function () {

        Route::prefix('auth')
//            ->middleware('web')
            ->group(function() {
                Route::get('clients','AuthController@clients');

                Route::post('client','AuthController@client');
                Route::get('logout', 'AuthController@logout')->name('logout');
                Route::middleware('jwt.refresh')->get('refresh','AuthController@refresh');

            });

        Route::middleware('web')->group(function () {
            Route::view('vue','paladin::vue.index');

            Route::get('app','LayoutController@app');
        });


        Route::redirect('/','/dashboard',301);



        //'jwt.refresh'
        //需要登陆的页面
        Route::middleware(['auth:admin','api'])
            ->group(function () {
                Route::get('me','AuthController@me');
                Route::get('layout/menu','LayoutController@menu');


                //首页
                Route::get('dashboard', 'DashBoardController@index');
                Route::get('dashboard/usage', 'DashBoardController@usage');
                Route::get('dashboard/routes', 'DashBoardController@routes');

                //Admin
                Route::get('/admin/{admin}/assign','AdminController@assign');
                Route::post('admin/{admin}/assign','AdminController@assign');
                Route::get('admin/{admin}/role','AdminController@role');
                Route::post('admin/{admin}/role','AdminController@role');
                Route::apiResource('admin', 'AdminController');

                //代码生成器
                Route::namespace('Generator')->prefix('generator/crud')->group(function (){
                   Route::get('','CrudController@show');
                   Route::get('model','CrudController@model');
                   Route::post('run','CrudController@run');
                });

                //Role
                Route::match(['get','post'],'/role/{role}/assign','RoleController@assign');
                Route::get('role/{role}/delete','RoleController@destroy');;
                Route::resource('role','RoleController');

                //Permission
//                Route::get('permission/{permission}/delete','PermissionController@destroy');
                Route::resource('permission','PermissionController');

                //Menu
//                Route::get('menu/create/{parent?}','MenuController@create');
//                Route::get('menu/{menu}/delete','MenuController@destroy');
                Route::resource('menu','MenuController');

            });

        });


