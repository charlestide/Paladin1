<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Model\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->input('format') == 'json') {

            $permissions = Permission::query();

            return Datatables::of($permissions)->make(true);
        }

        return view('permission/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {

        return view('permission/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('permission')) {

            $permissionData = $request->input('permission');

            $permission = new Permission($permissionData);

            $permission->save();

            return redirect('/permission/'.$permission->id)->with('messageInfo',['title' => '保存信息', 'text' => '保存成功']);
        } else {
            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param    Permission  $permission
     * @return  \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('permission.show',['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    Permission  $permission
     * @return  \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permission/update',['permission' => $permission]);
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
        if ($request->has('permission')) {

            $permissionData = $request->input('permission');
            $permission->fill($permissionData);

            $permission->save();

            return redirect('/permission/'.$permission->id)->with('messageInfo',['title' => '保存信息', 'text' => '保存成功']);
        } else {
            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    Permission  $permission
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
