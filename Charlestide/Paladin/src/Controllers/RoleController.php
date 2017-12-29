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

//        $this->authorize('list',Role::class);

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
        $this->authorize('create',Role::class);

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
        $this->authorize('create',Role::class);

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
        $this->authorize('view',$role);

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
        $this->authorize('update',$role);

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
        $this->authorize('update',$role);

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
        $this->authorize('delete',$role);

    }

    /**
     * @param Request $request
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function assign(Request $request, Role $role) {

//        $this->authorize('assign',$role);


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