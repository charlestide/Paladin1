@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

<section id="page-content">

    <pvc-bread-crumb icon="user" title="创建权限" summary="权限列表">
        <pvc-bread-crumb-item title="权限" url="/admin"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="创建新权限">
            <pvc-form method="post" action="{{url('/permission')}}" token="{{csrf_token()}}" :validation="true">
                                                                                                                <pvc-textfield name="permission[name]" label="标识"></pvc-textfield>
                                                                                            <pvc-textfield name="permission[description]" label="描述"></pvc-textfield>
                                                                                                                                        <pvc-textfield name="permission[updated_at]" label="更新于"></pvc-textfield>
                                                                <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="{{url('/permission')}}" slot="footer" title="返回列表"></pvc-link-button>
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
