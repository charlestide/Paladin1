@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
<section id="page-content">

    <pvc-bread-crumb icon="user" title="创建管理员" summary="您可以在这里创建一个新管理员">
        <pvc-bread-crumb-item title="系统管理" url="#"></pvc-bread-crumb-item>
        <pvc-bread-crumb-item title="管理员" url="/admin"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        @if (Session::has('form_result'))
        <div class="row">
            <div class="col-md-12">
                <div class="callout callout-info mb-20">
                    <p> {{Session::get('form_result')}}</p>
                </div>
            </div>
        </div><!-- /.row -->
        @endif

        <pvc-panel title="创建新管理员">
            <pvc-form method="post" action="{{url('/admin')}}" token="{{csrf_token()}}" :validation="true">
                    <pvc-textfield name="admin[name]" required="true" :required="true" label="名称"></pvc-textfield>
                    <pvc-textfield name="admin[email]" required="true" :required="true" :email="true" label="邮箱"></pvc-textfield>
                    <pvc-textfield name="admin[password]" type="password" :required="true" label="密码"></pvc-textfield>
                    <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="{{url('/admin')}}" slot="footer" title="返回列表"></pvc-link-button>
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
