@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
    <pvc-bread-crumb icon="user" title="管理员" summary="管理员管理界面">
        <pvc-bread-crumb-item title="系统管理" url="#"></pvc-bread-crumb-item>
        <pvc-bread-crumb-item title="管理员" url="/admin"></pvc-bread-crumb-item>
    </pvc-bread-crumb>


    <pvc-panel>
        <pvc-button slot="head-right" action="{{url('/admin/create')}}" title="新增" icon="plus-square"></pvc-button>
        <pvc-datatable source="/admin?format=json">
            <pvc-data-column data="id" title="ID" width="10%"></pvc-data-column>
            <pvc-data-column data="name" title="名称" width="30%"></pvc-data-column>
            <pvc-data-column data="email" title="Email" width="20%"></pvc-data-column>
            <pvc-data-column data="updated_at" title="更新于" default="从未更新" width="20%"></pvc-data-column>
            <pvc-data-column-action action="/admin/{$model.id}" title="操作" width="20%">
                <pvc-button title="修改" action="/admin/{data.id}/edit" icon="edit" ></pvc-button>
                <pvc-button title="详情" action="/admin/{data.id}" icon="eye"></pvc-button>
                <pvc-button title="权限" action="/admin/{data.id}/assign" icon="user-secret"></pvc-button>
                <pvc-button title="角色" action="/admin/{data.id}/role" icon="users"></pvc-button>
            </pvc-data-column-action>
        </pvc-datatable>
    </pvc-panel>

@stop
<!--/ END PAGE CONTENT -->
