@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')


    <pvc-bread-crumb icon="user" title="角色" summary="角色列表">
        <pvc-bread-crumb-item title="角色" url="/role"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <pvc-panel>
        
        <pvc-button slot="head-right" action="{{url('/role/create')}}" title="新增" icon="plus-square"></pvc-button>
        
        <pvc-datatable source="/role?format=json">
            <pvc-data-column data="id" title="ID" default="无数据"></pvc-data-column>
            <pvc-data-column data="name" title="标识" default="无数据"></pvc-data-column>
            <pvc-data-column data="display_name" title="显示名称" default="无数据"></pvc-data-column>
            <pvc-data-column data="description" title="描述" default="无数据"></pvc-data-column>
            <pvc-data-column data="created_at" title="创建于" default="无数据"></pvc-data-column>
            <pvc-data-column data="updated_at" title="更新于" default="无数据"></pvc-data-column>
            <pvc-data-column-action title="操作" width="20%">
                <pvc-button title="修改" action="/role/{data.id}/edit" icon="edit" ></pvc-button>
                <pvc-button title="详情" action="/role/{data.id}" icon="eye"></pvc-button>
                <pvc-button title="权限" action="/role/{data.id}/assign" icon="user-secret"></pvc-button>
            </pvc-data-column-action>
        </pvc-datatable>
    </pvc-panel>

@push('scripts')
    <script type="text/javascript" src="/paladin/js/data.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->

