<?php
namespace Charlestide\Paladin\Controllers;

use Illuminate\Http\Request;
use Charlestide\Paladin\Services\Datatable;
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
        return Datatable::of(Role::query());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roleData = $request->only('name','display_name');

        $role = new Role($roleData);

        $role->save();

        return response()->success($role,'角色保存成功');
    }

    /**
     * Display the specified resource.
     *
     * @param    Role  $role
     * @return  \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return response()->success($role);
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

        $roleData = $request->only('name');
        $role->fill($roleData);
        $role->save();

        return response()->success($role,'角色已经修改成功');
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
            return response()->success('角色删除成功');
        } catch (\Exception $e) {
            return response()->failure('角色删除失败');
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
