@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

<section id="page-content">

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
                    <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="{{url('/menu')}}" slot="footer" title="返回列表"></pvc-link-button>
            </pvc-form>
        </pvc-panel>

    </div><!-- /.body-content -->
    <!--/ End body content -->

    <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

</section><!-- /#page-content -->
<script type="text/javascript" src="/js/form.js"></script>
@stop
<!--/ END PAGE CONTENT -->
