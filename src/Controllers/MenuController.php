<?php
namespace Charlestide\Paladin\Controllers;

use Charlestide\Paladin\Models\Permission;
use Illuminate\Http\Request;
use Charlestide\Paladin\Models\Menu;
use Charlestide\Paladin\Services\Datatable;


class MenuController extends Controller
{

    public function __construct()
    {
        $this->restfulAuth('menus');
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return Datatable::of(
                Menu::with([
                    'permission.users',
                    'permission.roles',
                ])->orderBy('parent_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateMenu($request,true);
        $menu = new Menu($request->all());
        $menu->save();
        $menu->related()->sync($request->parent_path);

        $menu->permission;
        $menu->related;

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
        $menu->permission->roles;
        $menu->permission['admins'] = $menu->permission->users;
        $menu->related;
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
        $this->validateMenu($request,false);
        $menu->fill($request->all());
        $menu->save();

        $menu->permission;
        $menu->related;
        $menu->parent;

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

    private function validateMenu(Request $request,bool $isCreate) {
        $rules =[
            'name' => 'required|max:30',
            'parent_path' => 'required',
            'parent_id' => 'required|integer',
        ];

        if ($isCreate) {
            $rules['name'] .= '|unique:menu';
        }
        $this->validate($request, $rules);
    }
}
