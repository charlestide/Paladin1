@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

    <pvc-bread-crumb icon="user" title="角色信息" summary="角色详情">
        <pvc-bread-crumb-item title="角色" url="/role"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="#{{$role->id}}">
            <pvc-form>
                <pvc-label-field label="ID" value="{{$role->id}}"></pvc-label-field>
                <pvc-label-field label="标识" value="{{$role->name}}"></pvc-label-field>
                <pvc-label-field label="显示名称" value="{{$role->display_name}}"></pvc-label-field>
                <pvc-label-field label="描述" value="{{$role->description}}"></pvc-label-field>
                <pvc-label-field label="创建于" value="{{$role->created_at}}"></pvc-label-field>
                <pvc-label-field label="更新于" value="{{$role->updated_at}}"></pvc-label-field>
                <pvc-button icon="list" title="返回列表" action="{{url('/role')}}" slot="footer"></pvc-button>
            </pvc-form>
        </pvc-panel>
    </div><!-- /.body-content -->
    <!--/ End body content -->

@push('scripts')
<script type="text/javascript" src="/js/form.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->


