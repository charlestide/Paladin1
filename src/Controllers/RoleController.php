<?php
namespace Charlestide\Paladin\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Models\Role;

class RoleController extends Controller
{

    protected $authModel = Role::class;

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('format') == 'json') {

            $roles = Role::query();

            return Datatables::of($roles)->make(true);
        }

        return view('paladin::role/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paladin::role/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('role')) {

            $roleData = $request->input('role');

            $role = new Role($roleData);

            $role->save();

            return redirect('/role/'.$role->id)->with('messageInfo',['title' => '保存信息', 'text' => '保存成功']);
        } else {
            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param    Role  $role
     * @return  \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('paladin::role.show',['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    Role  $role
     * @return  \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('paladin::role/update',['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    Role  $role
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if ($request->has('role')) {

            $roleData = $request->input('role');
            $role->fill($roleData);

            $role->save();

            return redirect('/role/'.$role->id)->with('messageInfo',['title' => '保存信息', 'text' => '保存成功']);
        } else {
            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    Role  $role
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
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

    /**
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function assign(Request $request, Role $role) {

        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $role->permissions()->saveMany(Permission::find($permissions));

            return redirect('/role/'.$role->id);
        } else {

            return view('paladin::role.assign',[
                'role' => $role,
                'permissions' => Permission::grouped(),
                'related' => $role->permissions->pluck('id')->toArray()
            ]);
        }
    }
}
