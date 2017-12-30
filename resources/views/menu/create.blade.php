@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

    <pvc-bread-crumb icon="user" title="创建菜单" summary="菜单列表">
        <pvc-bread-crumb-item title="菜单" url="/menu"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="创建新菜单">
            <pvc-form method="post" action="{{url('/menu')}}" token="{{csrf_token()}}" :validation="true">
                    <pvc-textfield name="menu[icon]" label="图标"></pvc-textfield>
                    <pvc-textfield name="menu[name]" label="菜单名"></pvc-textfield>
                    <pvc-textfield name="menu[url]" label="URL"></pvc-textfield>
                    <pvc-label-field label="父菜单" value="{{$parent->id ? $parent->name : '顶层菜单'}}"></pvc-label-field>
                    <pvc-hidden-field name="menu[parent_id]" value="{{intval($parent->id)}}"></pvc-hidden-field>
                    <pvc-button type="submit" icon="save" slot="footer" title="保存"></pvc-button>
                    <pvc-button action="{{url('/menu')}}" slot="footer" icon="list" title="返回列表"></pvc-button>
            </pvc-form>
        </pvc-panel>

    </div><!-- /.body-content -->

@push('scripts')
    <script type="text/javascript" src="/js/form.js"></script>
@endpush
@stop
<!--/ END PAGE CONTENT -->
