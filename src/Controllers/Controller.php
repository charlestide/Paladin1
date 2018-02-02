<?php

namespace Charlestide\Paladin\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
    }

    /**
     * @param string|null $module
     */
    protected function restfulAuth(string $module = null) {
        $this->permissionMiddleware('browse','index',$module);
        $this->permissionMiddleware('show','show',$module);
        $this->permissionMiddleware('create','store',$module);
        $this->permissionMiddleware('update','update',$module);
        $this->permissionMiddleware('delete','destroy',$module);
    }

    /**
     * @param string $permissionAction
     * @param string $controllerAction
     * @param string|null $module
     */
    protected function permissionMiddleware(string $permissionAction,string $controllerAction,string $module = null) {
        if (empty($module) and isset($this->module)) {
            $module = $this->module;
        }

        if ($module) {
            $this->middleware('permission:'.__($permissionAction).' '.__($module))->only($controllerAction);
        }
    }

}
