@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

    <pvc-bread-crumb icon="user" title="指定角色" summary="您可以为管理员指定角色">
        <pvc-bread-crumb-item title="系统管理" url="#"></pvc-bread-crumb-item>
        <pvc-bread-crumb-item title="管理员" url="/admin"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
            <pvc-panel title="请为管理员 {{$admin->display_name}} 指定角色" :collapsible="true">
                <pvc-form method="post" action="{{url("/admin/$admin->id/role")}}" token="{{csrf_token()}}">
                    <pvc-checkbox  label="请选择角色" name="roles[]" >
                        @foreach($roles as $prefix => $role)
                        <pvc-option value="{{$role->id}}" label="{{$role->display_name}} ({{$role->name}})" :checked="{{in_array($role->id,$related) ? 'true' : 'false'}}"></pvc-option>
                        @endforeach
                    </pvc-checkbox>
                    <pvc-button type="submit" icon="save" title="保存" slot="footer"></pvc-button>
                    <pvc-button action="{{url('/admin')}}" slot="footer" icon="list" title="返回列表"></pvc-button>
                </pvc-form>
            </pvc-panel>

    </div><!-- /.body-content -->
    <!--/ End body content -->

@push('scripts')
<script type="text/javascript" src="/paladin/js/form.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->
