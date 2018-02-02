<?php
namespace Charlestide\Paladin\Controllers;

use Charlestide\Paladin\Models\Permission;
use Illuminate\Http\Request;
use Charlestide\Paladin\Services\Datatable;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->restfulAuth('permissions');
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Datatable::of(
            Permission::withCount('users as admins_count','roles')->with('category')
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validatePermission($request,true);
        $permission = new Permission($request->all());
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
        $permission->admins = $permission->users;
        $permission->related;
        $permission->category;
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
        $this->validatePermission($request,false);
        $permission->fill($request->all());
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
            return response()->success(null,'权限 删除成功');
        } catch (\Exception $e) {
            return response()->failure(null,'权限 删除失败');
        }
    }

    private function validatePermission(Request $request, bool $isCreate) {
        $rules = [
            'name' => 'required|max:30'
        ];

        if ($isCreate) {
            $rules['name'] .= '|unique:permissions';
        }

        $this->validate($request,$rules);
    }
}
