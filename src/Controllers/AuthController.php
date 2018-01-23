<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/9
 * Time: 上午10:28
 */

namespace Charlestide\Paladin\Controllers;

use Illuminate\Http\Request;

use Laravel\Passport\ClientRepository;
use Charlestide\Paladin\Models\Admin;

class AuthController extends Controller
{

    /**
     * @var ClientRepository
     */
    protected $clients;

    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }

    public function me(Request $request) {
        return $request->user();
    }

    public function client(Request $request)
    {
        $username = $request->input('username');
        $admin = Admin::where('email', $username)->first();

        if ($admin) {
            $clients = $this->clients->activeForUser($admin->id);
            $passwordClient = $clients->where('password_client',true)->firstWhere('name','admin');

            if (!$passwordClient) {
                $passwordClient = $this->clients->createPasswordGrantClient($admin->id,'admin',env('APP_URL'));
            }

            if ($passwordClient) {
                return response()->success($passwordClient->makeVisible('secret')->only(['id','secret']),'登陆成功');
            } else {
                return response()->error('创建客户端异常',500);
            }
        } else {
            return response()->error('用户名或密码错误',401);
        }
    }

    public function logout() {
        if (auth('admin')->check()) {
            auth('admin')->user()->token()->delete();
        }

        return response()->success(null,'登出成功');
    }

}