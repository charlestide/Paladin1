@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
<section id="page-content">

    <pvc-bread-crumb icon="user" title="分配权限" summary="您可以为角色分配权限">
        <pvc-bread-crumb-item title="系统管理" url="#"></pvc-bread-crumb-item>
        <pvc-bread-crumb-item title="角色" url="/role"></pvc-bread-crumb-item>
    </pvc-bread-crumb>



    <!-- Start body content -->
    <div class="body-content animated fadeIn">
            <pvc-panel title="请为角色 {{$role->display_name}} 分配权限" :collapsible="true" :closeable="true">
                <pvc-form method="post" action="{{url("/role/$role->id/assign")}}" token="{{csrf_token()}}">
                    @foreach($permissions as $prefix => $permissionGroup)
                    <pvc-checkbox  label="{{$prefix}}" name="permissions[]" >
                        @foreach($permissionGroup as $permission)
                        <pvc-option value="{{$permission->id}}" label="{{$permission->description}} ({{$permission->name}})" :checked="{{in_array($permission->id,$related) ? 'true' : 'false'}}"></pvc-option>
                        @endforeach
                    </pvc-checkbox>
                    @endforeach
                    <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="{{url('/role')}}" slot="footer" slot="footer" title="返回列表"></pvc-link-button>
                </pvc-form>
            </pvc-panel>

    </div><!-- /.body-content -->
    <!--/ End body content -->

    @include('layouts._footer-admin')
    <!--/ End footer content -->

</section><!-- /#page-content -->
<script type="text/javascript" src="/js/form.js"></script>

@stop
<!--/ END PAGE CONTENT -->
