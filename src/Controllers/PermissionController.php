<?php
namespace Charlestide\Paladin\Controllers;

use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Services\AuthService;
use Illuminate\Http\Request;
use Charlestide\Paladin\Services\Datatable;

class PermissionController extends Controller
{

    protected $authModel = Permission::class;

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Datatable::of(Permission::withCount('admins','roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permissionData = $request->only('name');

        $permission = new Permission($permissionData);
        $permission->save();

        return response()->success($permission,'权限 保存成功');
    }

    /**
     * Display the specified resource.
     *
     * @param    Permission  $permission
     * @return  \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        $permission->roles;
        $permission->admins;
        return response()->success($permission);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    Permission  $permission
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $permissionData = $request->only('name');
        $permission->fill($permissionData);
        $permission->save();

        return response()->success($permission,'权限 修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    Permission  $permission
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return response()->success('权限 删除成功');
        } catch (\Exception $e) {
            return response()->failure('权限 删除失败');
        }
    }
}
