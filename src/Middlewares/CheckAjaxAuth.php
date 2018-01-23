<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/1/14
 * Time: 下午5:06
 */

namespace Charlestide\Paladin\Middlewares;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\JsonResponse;


class CheckAjaxAuth
{

    /**
     * @param Request $request
     * @param Closure $next
     * @param array $maps
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next, array $maps = []) {
        if (!Auth::check()) {

            return new JsonResponse([
                'message' => '您还没有登陆'
            ],401);
        }

        return $next($request);

    }

}