<?php

namespace Charlestide\Paladin\Controllers;

use Charlestide\Paladin\Models\Role;
use Charlestide\Paladin\Models\Admin;
use Charlestide\Paladin\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
    public function index(Request $request)
    {

        if ($request->input('format') == 'json') {

            $admins = Admin::query();

            return Datatables::of($admins)->make(true);
        }

        return view('paladin::admin/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paladin::admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('admin')) {

            $adminData = $request->input('admin');

            $admin = new Admin($adminData);

            if (isset($adminData['password']) and !empty($adminData['password']) ) {
                $admin->password = $adminData['password'];
            }

            $admin->save();

            return redirect('/admin/'.$admin->id)->with('tip','管理员 保存成功');
        } else {
            return redirect()->back()->with('tip','管理员 保存成功');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('paladin::admin.show',['admin' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('paladin::admin/update',['admin' => $admin]);
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
        if ($request->has('admin') and $admin->id > 1) {

            $adminData = $request->input('admin');
            $admin->fill($adminData);

            if ($adminData['password']) {
                $admin->password = $adminData['password'];
            }

            $admin->save();

            return redirect('/admin/'.$admin->id)->with('messageInfo',['title' => '保存管理员', 'text' => '保存成功']);
        } else {
            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
            die('错误的提交');
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
            return redirect()->with('tip','删除成功');
        } catch (\Exception $e) {
            return redirect()->back()->with('tip','删除失败');
        }
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
