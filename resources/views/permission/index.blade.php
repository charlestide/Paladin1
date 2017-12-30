@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

    <pvc-bread-crumb icon="user" title="权限" summary="权限列表">
        <pvc-bread-crumb-item title="权限" url="/permission"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <pvc-panel>
        
        <pvc-button slot="head-right" action="{{url('/permission/create')}}" title="新增" icon="plus-square"></pvc-button>
        
        <pvc-datatable source="/permission?format=json">
            <pvc-data-column data="id" title="ID" default="无数据"></pvc-data-column>
            <pvc-data-column data="name" title="标识" default="无数据"></pvc-data-column>
            <pvc-data-column data="description" title="描述" default="无数据"></pvc-data-column>
            <pvc-data-column data="created_at" title="创建于" default="无数据"></pvc-data-column>
            <pvc-data-column data="updated_at" title="更新于" default="无数据"></pvc-data-column>
            <pvc-data-column-action title="操作">
                <pvc-button title="修改" action="/permission/{data.id}/edit" icon="edit" ></pvc-button>
                <pvc-button title="详情" action="/permission/{data.id}" icon="eye"></pvc-button>
            </pvc-data-column-action>
        </pvc-datatable>
    </pvc-panel>

@stop
<!--/ END PAGE CONTENT -->

