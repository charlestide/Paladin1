@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')


    <pvc-bread-crumb icon="user" title="分配权限" summary="您可以为管理员分配权限">
        <pvc-bread-crumb-item title="系统管理" url="#"></pvc-bread-crumb-item>
        <pvc-bread-crumb-item title="管理员" url="/admin"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
            <pvc-panel title="请为管理员 {{$admin->display_name}} 分配权限" :collapsible="true" :closeable="true">
                <pvc-form method="post" action="{{url("/admin/$admin->id/assign")}}" token="{{csrf_token()}}">
                    @foreach($permissions as $prefix => $permissionGroup)
                    <pvc-checkbox  label="{{$prefix}}" name="permissions[]" >
                        @foreach($permissionGroup as $permission)
                        <pvc-option value="{{$permission->id}}" label="{{$permission->description}} ({{$permission->name}})" :checked="{{in_array($permission->id,$related) ? 'true' : 'false'}}"></pvc-option>
                        @endforeach
                    </pvc-checkbox>
                    @endforeach
                    <pvc-button type="submit" slot="footer" icon="save" title="保存"></pvc-button>
                    <pvc-button action="{{url('/admin')}}" slot="footer" icon="list" title="返回列表"></pvc-button>
                </pvc-form>
            </pvc-panel>

    </div><!-- /.body-content -->
    <!--/ End body content -->

@push('scripts')
<script type="text/javascript" src="/js/form.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->
