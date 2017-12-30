@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')


    <pvc-bread-crumb icon="user" title="菜单信息" summary="菜单详情">
        <pvc-bread-crumb-item title="菜单" url="/menu"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="#{{$menu->id}}">
            <pvc-form >
                <pvc-label-field label="图标" value="{{$menu->icon}}"></pvc-label-field>
                <pvc-label-field label="菜单名" icon="{{$menu->icon}}" value="{{$menu->name}}"></pvc-label-field>
                <pvc-label-field label="URL" value="{{$menu->url}}"></pvc-label-field>
                <pvc-label-field label="父菜单" value="{{$menu->parent ? $menu->parent->name : '顶层菜单'}}"></pvc-label-field>
                <pvc-label-field label="创建于" value="{{$menu->created_at}}"></pvc-label-field>
                <pvc-label-field label="更新于" value="{{$menu->updated_at}}"></pvc-label-field>
                <pvc-button title="返回列表" icon="list" action="{{url('/menu')}}" slot="footer"></pvc-button>
            </pvc-form>
        </pvc-panel>
    </div><!-- /.body-content -->
    <!--/ End body content -->

@push('scripts')
<script type="text/javascript" src="/js/form.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->


