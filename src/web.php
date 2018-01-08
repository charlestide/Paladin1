<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午4:29
 */



Route::aliasMiddleware('autoauth','Charlestide\Paladin\Middlewares\AutoAuth');
Route::middlewareGroup('paladin',['Charlestide\Paladin\Middlewares\AutoAuth']);

Route::namespace('Charlestide\Paladin\Controllers')
    ->middleware('web')
    ->group(function () {

        Route::redirect('/','/dashboard',301);
        Route::view('vue','paladin::vue.index');

        Route::get('layout/menu','LayoutController@menu');

        Route::get('login','LoginController@showLoginForm')->name('login');
        Route::post('login','LoginController@login');
        Route::get('logout', 'LoginController@logout')->name('logout');


        //需要登陆的页面
        Route::middleware('auth','paladin')
            ->group(function () {
                //首页
                Route::get('dashboard', 'DashBoardController@index');
                Route::get('dashboard/usage', 'DashBoardController@usage');
                Route::get('dashboard/routes', 'DashBoardController@routes');

                //Admin
                Route::get('/admin/{admin}/assign','AdminController@assign');
                Route::post('admin/{admin}/assign','AdminController@assign');
                Route::get('admin/{admin}/role','AdminController@role');
                Route::post('admin/{admin}/role','AdminController@role');
                Route::resource('admin', 'AdminController');

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
                Route::get('permission/{permission}/delete','PermissionController@destroy');
                Route::resource('permission','PermissionController');

                //Menu
                Route::get('menu/create/{parent?}','MenuController@create');
                Route::get('menu/{menu}/delete','MenuController@destroy');
                Route::resource('menu','MenuController',['except' => ['create','delete']]);

            });

        });

