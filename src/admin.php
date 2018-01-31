<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午4:29
 */

//Route::aliasMiddleware('autoauth','Charlestide\Paladin\Middlewares\AutoAuth');
//Route::middlewareGroup('paladin',[
//    'Charlestide\Paladin\Middlewares\AutoAuth',
//]);

Route::aliasMiddleware('auth-admin',\Charlestide\Paladin\Middlewares\AuthenticateAdminApi::class);

Route::namespace('Charlestide\Paladin\Controllers')
    ->group(function () {

        Route::prefix('auth')
            ->group(function() {
                Route::get('clients','AuthController@clients');

                Route::post('client','AuthController@client');
                Route::get('logout', 'AuthController@logout')->name('logout');

            });

        Route::view('dashboard','paladin::admin.index');

        //需要登陆的页面
        Route::middleware(['auth:admin','api'])
            ->group(function () {
                Route::get('me','AuthController@me');
                Route::get('layout/menu','LayoutController@menu');


                //代码生成器
//                Route::namespace('Generator')->prefix('generator/crud')->group(function (){
//                   Route::get('','CrudController@show');
//                   Route::get('model','CrudController@model');
//                   Route::post('run','CrudController@run');
//                });

                //Admin
                Route::apiResource('admin', 'AdminController');
                //Role
                Route::resource('role','RoleController');
                //Permission
                Route::resource('permission','PermissionController');
                //Menu
                Route::resource('menu','MenuController');
                Route::resource('permission-category','PermissionCategoryController');
            });

        });


