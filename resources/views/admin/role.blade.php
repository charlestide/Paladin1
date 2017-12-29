@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
<section id="page-content">

    <pvc-bread-crumb icon="user" title="指定角色" summary="您可以为管理员指定角色">
        <pvc-bread-crumb-item title="系统管理" url="#"></pvc-bread-crumb-item>
        <pvc-bread-crumb-item title="管理员" url="/admin"></pvc-bread-crumb-item>
    </pvc-bread-crumb>



    <!-- Start body content -->
    <div class="body-content animated fadeIn">
            <pvc-panel title="请为管理员 {{$admin->display_name}} 指定角色" :collapsible="true" :closeable="true">
                <pvc-form method="post" action="{{url("/admin/$admin->id/assign")}}" token="{{csrf_token()}}">
                    <pvc-checkbox  label="请选择角色" name="permissions[]" layout="ver" >
                        @foreach($roles as $prefix => $role)
                        <pvc-option value="{{$role->id}}" label="{{$role->display_name}} ({{$role->name}})" :checked="{{in_array($role->id,$related) ? 'true' : 'false'}}"></pvc-option>
                        @endforeach
                    </pvc-checkbox>
                    <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="{{url('/admin')}}" slot="footer" slot="footer" title="返回列表"></pvc-link-button>
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
