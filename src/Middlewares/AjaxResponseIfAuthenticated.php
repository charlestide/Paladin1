<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/1/14
 * Time: 下午7:31
 */

namespace Charlestide\Paladin\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AjaxResponseIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null) {

        if (Auth::guard($guard)->check()) {
            return response()->success(null,'您已经登陆了');
        }

        return $next($request);

    }
}