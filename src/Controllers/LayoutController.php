<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/7
 * Time: 下午11:46
 */

namespace Charlestide\Paladin\Controllers;


use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Models\Permission;
use Laravel\Passport\ClientRepository;
use Illuminate\Http\Request;


class LayoutController extends Controller
{

    protected $clients;

    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }

    public function menu() {

        if (auth('admin')->user()->id == 1) {
            $permissionIds = Permission::all()->pluck('id');
        } else {
            $permissionIds = auth('admin')->user()->getAllPermissions()->pluck('id');
        }
        $menuTree = Menu::whereHas('permission', function($query) use ($permissionIds) {
            $query->whereIn('id', $permissionIds);
        })->get();

        return response()->success($menuTree,'菜单列表 获取成功');
    }

    public function app(Request $request) {

        $userId = $request->user()->getKey();
        $clients = $this->clients->activeForUser($userId);
        $passwordClient = $clients->firstWhere('password_client',true);

        return view('paladin::vue.index',['client' => $passwordClient]);
    }
}