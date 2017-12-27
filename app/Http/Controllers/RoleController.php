<?php 
namespace App\Http\Controllers;

use App\Model\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Model\Role;

class RoleController extends Controller
{
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

        return view('role/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {

        return view('role/create');
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
        return view('role.show',['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    Role  $role
     * @return  \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('role/update',['role' => $role]);
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
        //
    }

    public function assign(Request $request, Role $role) {
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            $role->permissions()->saveMany(Permission::find($permissions));

            return redirect('/role/'.$role->id);
        } else {

            return view('role.assign',[
                'role' => $role,
                'permissions' => Permission::grouped(),
                'related' => $role->permissions->pluck('id')->toArray()
            ]);
        }
    }
}
