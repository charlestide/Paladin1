<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Model\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->input('format') == 'json') {

            $admins = Admin::query();

            return Datatables::of($admins)
                ->addColumn('action', function ( $admin) {
                    return '<a href="'.url('/admin/'.$admin->id).'" class="btn btn-xs bg-color-blueDark txt-color-white">'
                        . '<i class="fa fa-detail"></i> 查看</a>';
                })
                ->make(true);
        }

        return view('admin/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/create');
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

            return redirect('/admin/'.$admin->id)->with('messageInfo',['title' => '保存管理员', 'text' => '保存成功']);
        } else {
//            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
            die('错误的提交');
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
        return view('admin.show',['admin' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin/update',['admin' => $admin]);
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
//            return redirect()->back()->with('messageInfo',['title' => '错误', 'text' => '错误的提交']);
            die('错误的提交');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
