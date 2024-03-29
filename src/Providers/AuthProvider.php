<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2017/12/29
 * Time: 下午7:56
 */

namespace Charlestide\Paladin\Providers;


use Charlestide\Paladin\Services\Paladin;
use Illuminate\Support\Facades\Response;
use Charlestide\Paladin\Auth\AdminPassportRepository;
use League\OAuth2\Server\Grant\PasswordGrant;
use Laravel\Passport\PassportServiceProvider as BasePassportServiceProvider;
use Laravel\Passport\Passport;

class AuthProvider extends BasePassportServiceProvider
{

    protected $policies = [
        \Charlestide\Paladin\Models\Admin::class => \Charlestide\Paladin\Policies\AdminPolicy::class,
        \Charlestide\Paladin\Models\Role::class => \Charlestide\Paladin\Policies\RolePolicy::class,
        \Charlestide\Paladin\Models\Permission::class => \Charlestide\Paladin\Policies\PermissionPolicy::class,
        \Charlestide\Paladin\Models\Menu::class => \Charlestide\Paladin\Policies\MenuPolicy::class,
    ];


    public function boot() {
        Response::macro('success',function ($data, string $message = null) {
            return Response::json([
                'status' => true,
                'data' => $data,
                'auth' => auth(config('paladin.guard','web'))->user(),
                'message' => $message ?: '成功',
                'version' => Paladin::version()
            ]);
        });

        Response::macro('failure',function ($data, string $message = null) {
            return Response::json([
                'status' => false,
                'data' => $data,
                'auth' => auth(config('paladin.guard','web'))->user(),
                'message' => $message ?: '失败',
                'version' => Paladin::version()
            ]);
        });

        Response::macro('error',function (string $message = null,int $status = 401,$data = null) {
            return Response::json([
                'status' => false,
                'data' => $data,
                'message' => $message ?: '失败',
                'version' => Paladin::version()
            ])->setStatusCode($status);
        });

        parent::boot();
    }

    public function register()
    {
        parent::register();
    }

    protected function makePasswordGrant()
    {
        $grant = new PasswordGrant(
        //主要是这里，我们调用我们自己UserRepository
            $this->app->make(AdminPassportRepository::class),
            $this->app->make(\Laravel\Passport\Bridge\RefreshTokenRepository::class)
        );

        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }
}