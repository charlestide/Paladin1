<?php
namespace Charlestide\Paladin\Controllers;

use Charlestide\Paladin\Models\PermissionCategory;
use Illuminate\Http\Request;
use Charlestide\Paladin\Services\Datatable;

class PermissionCategoryController extends Controller
{

    protected $authModel = PermissionCategory::class;

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Datatable::of(PermissionCategory::query());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validatePermissionCategory($request,true);
        $permissionCategory = new PermissionCategory($request->all());
        $permissionCategory->save();

        return response()->success($permissionCategory,'权限类别 保存成功');
    }

    /**
     * Display the specified resource.
     *
     * @param    PermissionCategory  $permissionCategory
     * @return  \Illuminate\Http\Response
     */
    public function show(PermissionCategory $permissionCategory)
    {
        $permissionCategory->roles;
        $permissionCategory->admins = $permissionCategory->users;
        $permissionCategory->related;
        return response()->success($permissionCategory);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    PermissionCategory  $permissionCategory
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, PermissionCategory $permissionCategory)
    {
        $this->validatePermissionCategory($request,false);
        $permissionCategory->fill($request->all());
        $permissionCategory->save();

        return response()->success($permissionCategory,'权限类别 修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    PermissionCategory  $permissionCategory
     * @return  \Illuminate\Http\Response
     */
    public function destroy(PermissionCategory $permissionCategory)
    {
        try {
            $permissionCategory->delete();
            return response()->success(null,'权限类别 删除成功');
        } catch (\Exception $e) {
            return response()->failure(null,'权限类别 删除失败');
        }
    }

    private function validatePermissionCategory(Request $request, bool $isCreate) {
        $rules = [
            'name' => 'required|max:30'
        ];

        if ($isCreate) {
            $rules['name'] .= '|unique:permission_category';
        }

        $this->validate($request,$rules);
    }
}
