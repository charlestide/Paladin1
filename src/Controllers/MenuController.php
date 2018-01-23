<?php
namespace Charlestide\Paladin\Controllers;

use Charlestide\Paladin\Models\Permission;
use Illuminate\Http\Request;
use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Services\Datatable;


class MenuController extends Controller
{

    protected $authModel = Menu::class;

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Datatable::of(Menu::query()->orderBy('parent_id'));
    }

    public function tree() {
        $menuTree = Menu::wholeTree();

        return response()->success($menuTree->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $menuData = $request->only('name','id','parent_id','permission_id','icon','path');
        $menu = new Menu($request->all());
        $menu->save();

        return response()->success($menu,'菜单创建成功');
    }

    /**
     * Display the specified resource.
     *
     * @param    Menu  $menu
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Menu $menu)
    {
        $menu->parent;
        return response()->success($menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    Menu  $menu
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->fill($request->all());
        $menu->save();
        return response()->success($menu,'菜单 保存成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    Menu  $menu
     * @return string
     */
    public function destroy(Menu $menu)
    {
        try {
            $menu->delete();
            return response()->success(null,'菜单删除成功');
        } catch (\Exception $e) {
            return response()->failure(null,'菜单删除失败');
        }
    }
}
