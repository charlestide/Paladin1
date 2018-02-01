<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/31
 * Time: 下午8:06
 */

return [
    'version' => 1,

    //这个值会由/layout/settings接口，被客户端获取
    'settings' => [
        'logo_path' => '/paladin/images/logo.png',
    ],

    'permissions' => [
        'admins' => ['create','update','delete','show','browse'],
        'permissions' => ['create','update','delete','show','browse'],
        'permissions_categories' => ['create','update','delete','show','browse'],
        'menus' => ['create','update','delete','show','browse'],
        'roles' => ['create','update','delete','show','browse'],
    ]
];