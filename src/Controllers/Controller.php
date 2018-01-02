<?php

namespace Charlestide\Paladin\Controllers;

use Charlestide\Paladin\Middlewares\AutoAuth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $authModel = '';

    public function __construct()
    {

    }

    public function getAuthModel() {
        return $this->authModel;
    }

    protected function success($message) {
        session()->flash('tip',$message);
        session()->flash('tipStatus','success');
    }

    protected function error($message) {
        session()->flash('tip',$message);
        session()->flash('tipStatus','error');
    }

    protected function info($message) {
        session()->flash('tip',$message);
        session()->flash('tipStatus','info');
    }

}
