<?php

namespace Charlestide\Paladin\Controllers;

use Charlestide\Paladin\Models\Role;
use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Models\Permission;
use Illuminate\Http\Request;
use Charlestide\Paladin\Services\Datatable;

class AdminController extends Controller
{

    /**
     * @var string 需要验证权限的Model
     */
    protected $authModel = Admin::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Datatable::of(Admin::query());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateAdmin($request);
        $admin = new Admin($request->all());

        if ($password = $request->input('password') ) {
            $admin->password = $password;
        }

        $admin->save();

        $admin->syncPermissions($request->input('permissionNames'));
        $admin->syncRoles($request->input('roleNames'));

        $admin->permissions;
        $admin->roles;

        return response()->success($admin,'管理员 保存成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  Admin  $admin
     * @return Admin
     */
    public function show(Admin $admin)
    {
        $admin->roles;
        $admin->permissions;
        return response()->success($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        if ($admin->id > 1) {
            $admin->fill($request->all());

            if ($request->has('password')) {
                $admin->password = $request->input('password');
            }

            $admin->save();

            $admin->syncPermissions($request->input('permissionNames'));
            $admin->syncRoles($request->input('roleNames'));

            $admin->permissions;
            $admin->roles;

            return response()->success($admin,'管理员已经修改成功');
        } else {
            return response()->failure($admin,'您不能修改超级管理员');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            return response()->success('管理员删除成功');
        } catch (\Exception $e) {
            return response()->failure('管理员删除失败');
        }
    }

    private function validateAdmin(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:admins|max:30',
        ]);
    }


    public function assign(Request $request, Admin $admin) {
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $admin->permissions()->saveMany(Permission::find($permissions));

            return redirect('/admin/'.$admin->id);
        } else {

            return view('paladin::admin.assign',[
                'admin' => $admin,
                'permissions' => Permission::grouped(),
                'related' => $admin->permissions->pluck('id')->toArray()
            ]);
        }
    }

    public function role(Request $request,Admin$admin) {
        if ($request->has('roles') and $request->isMethod('post')) {
            $roles = $request->input('roles');
            $admin->roles()->saveMany(Role::find($roles));

            return redirect('/admin/'.$admin->id.'/role');
        } else {

            return view('paladin::admin.role',[
                'admin' => $admin,
                'roles' => Role::all(),
                'related' => $admin->roles->pluck('id')->toArray()
            ]);
        }
    }
}
