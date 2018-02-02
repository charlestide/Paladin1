<?php
/**
 * Created by PhpStorm.
 * User: tangkeyu<charlestide@vip.163.com>
 * Date: 2018/1/20
 * Time: 下午5:30
 */

namespace Charlestide\Paladin\Middlewares;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthenticateAdminApi extends Authenticate
{
    protected function authenticate(array $guards)
    {

        if ($this->auth->guard(config('paladin.guard','web'))->check()) {
            return $this->auth->shouldUse(config('paladin.guard','web'));
        } else {
            throw new UnauthorizedHttpException('', 'Unauthenticated');
        }
    }
}