<?php
namespace Charlestide\Paladin\Controllers;

use Illuminate\Http\Request;
use Charlestide\Paladin\Services\Datatable;
use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->restfulAuth('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Datatable::of(Role::with('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRole($request,true);
        $role = new Role($request->all());
        $role->save();
        if ($permissionNames = $request->input('permissionNames')) {
            $role->syncPermissions($request->input('permissionNames'));
        }

        return response()->success($role,'角色保存成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @param    Role  $role
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request,Role $role)
    {
        $role->admins = $role->users;
        $role->permissions;
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
        $this->validateRole($request,false);
        $role->fill($request->all());
        if (is_array($request->input('permissionNames'))) {
            $role->syncPermissions($request->input('permissionNames'));
        }
        $role->save();

        $role->permissions;

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

    private function validateRole(Request $request,bool $isCreate) {
        $rules =[
            'name' => 'required|max:30',
        ];

        if ($isCreate) {
            $rules['name'] .= '|unique:roles';
        }
        $this->validate($request, $rules);
    }
}
