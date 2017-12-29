<?php
namespace Charlestide\Paladin\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Charlestide\Paladin\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->input('format') == 'json') {

            $menus = Menu::query();


            return Datatables::of($menus)->make(true);
        }


        return view('menu/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create(Menu $parent)
    {
        return view('menu/create',[
            'parent' => $parent
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('menu')) {

            $menuData = $request->input('menu');

            $menu = new Menu($menuData);

            $menu->save();

            return redirect('/menu/'.$menu->id)->with('messageInfo',['title' => '保存信息', 'text' => '保存成功']);
        } else {
            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param    Menu  $menu
     * @return  \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('menu.show',['menu' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    Menu  $menu
     * @return  \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menu/update',['menu' => $menu]);
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
        if ($request->has('menu')) {

            $menuData = $request->input('menu');
            $menu->fill($menuData);

            $menu->save();

            $this->success('保存成功');

            return redirect('/menu/'.$menu->id);
        } else {
            $this->error('错误的提交');
            return redirect()->back();
        }
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
            return redirect()->with([
                'title' => '删除信息',
                'text' => '删除成功',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'title' => '删除信息',
                'text' => '删除失败: '. $e->getMessage(),
            ]);
        }
    }
}
