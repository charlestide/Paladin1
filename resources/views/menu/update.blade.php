@extends('layouts.lay_admin')

    <!-- START @PAGE CONTENT -->
@section('content')


    <pvc-bread-crumb icon="user" title="修改菜单" summary="在这里你可以修改菜单">
        <pvc-bread-crumb-item title="菜单" url="/menu"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
        <pvc-panel title="#{{$menu->id}}" :closeable="true">
            <pvc-form method="post" action=" {{url('/menu/'.$menu->id)}}" token="{{csrf_token()}}" :validation="true">

                    <pvc-hidden-field slot="hidden" name="菜单[id]" value="{{$menu->id}}"></pvc-hidden-field>
                    {{method_field('PUT')}}
                    <pvc-textfield name="menu[icon]" value="{{$menu->icon}}" label="图标"></pvc-textfield>
                    <pvc-textfield name="menu[name]" value="{{$menu->name}}" label="菜单名" :required="true"></pvc-textfield>
                    <pvc-textfield name="menu[url]" value="{{$menu->url}}" label="URL"></pvc-textfield>
                    <pvc-chosen name="menu[permission_id]" label="指定权限" value="{{$menu->permission_id}}" placeholder="请选择一个权限">
                        @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->name}}</option>
                        @endforeach
                    </pvc-chosen>
                    <pvc-label-field value="{{$menu->parent ? $menu->parent->name : '顶层菜单'}}" label="父菜单"></pvc-label-field>
                    <pvc-hidden-field name="menu[parent_id]" value="{{$menu->parent_id}}"></pvc-hidden-field>
                    <pvc-button type="submit" icon="save" slot="footer" title="保存"></pvc-button>
                    <pvc-button action="{{url('/menu')}}" icon="list" slot="footer" title="返回列表"></pvc-button>
            </pvc-form>
        </pvc-panel>

    </div><!-- /.body-content -->
    <!--/ End body content -->
@push('scripts')
<script type="text/javascript" src="/js/form.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->

