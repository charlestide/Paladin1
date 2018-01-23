<?php
/**
 * Created by PhpStorm.
 * User: yuyu
 * Date: 2018/1/7
 * Time: 下午11:46
 */

namespace Charlestide\Paladin\Controllers;


use Charlestide\Paladin\Models\Menu;
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

        $menuTree = Menu::wholeTree();

        return $menuTree->toArray();
    }

    public function app(Request $request) {

        $userId = $request->user()->getKey();
        $clients = $this->clients->activeForUser($userId);
        $passwordClient = $clients->firstWhere('password_client',true);

        return view('paladin::vue.index',['client' => $passwordClient]);
    }

}