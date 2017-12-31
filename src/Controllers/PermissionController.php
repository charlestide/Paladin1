<?php
namespace Charlestide\Paladin\Controllers;

use Charlestide\Paladin\Models\Permission;
use Charlestide\Paladin\Services\AuthService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{

    protected $authModel = Permission::class;

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request,AuthService $authService)
    {
        $authService::detectPermissions();

        if ($request->input('format') == 'json') {

            $permissions = Permission::query();

            return Datatables::of($permissions)->make(true);
        }

        return view('paladin::permission/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {

        return view('paladin::permission/create');
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
        return view('paladin::permission.show',['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    Permission  $permission
     * @return  \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('paladin::permission/update',['permission' => $permission]);
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
        try {
            $permission->delete();
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
}
