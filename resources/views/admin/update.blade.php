@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
<section id="page-content">

    <pvc-bread-crumb icon="user" title="修改管理员" summary="在这里您可以修改已存在管理员">
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

        <pvc-panel title="#{{$admin->id}} 管理员：{{$admin->name}}" :closeable="true">
            <pvc-form method="post" action="{{url('/admin/'.$admin->id)}}" token="{{csrf_token()}}" :validation="true">
                    <pvc-hidden-field slot="hidden" name="admin[id]" value="{{$admin->id}}"></pvc-hidden-field>
                    {{method_field('PUT')}}
                    <pvc-textfield name="admin[name]" value="{{$admin->name}}" :required="true" label="名称"></pvc-textfield>
                    <pvc-textfield name="admin[email]" value="{{$admin->email}}" :required="true" label="邮箱" :email="true"></pvc-textfield>
                    <pvc-textfield name="admin[password]" value="" label="密码" type="password"></pvc-textfield>
                    <pvc-label-field label="创建于" value="{!! Request::is('*/create') ? '未创建' : $admin->created_at !!}"></pvc-label-field>
                    <pvc-label-field label="更新于" value="{!! Request::is('*/create') ? '未创建' : $admin->updated_at !!}"></pvc-label-field>
                    <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="{{url('/admin')}}" slot="footer" slot="footer" title="返回列表"></pvc-link-button>
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
