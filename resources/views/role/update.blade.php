@extends('layouts.lay_admin')

    <!-- START @PAGE CONTENT -->
@section('content')

<section id="page-content">

    <pvc-bread-crumb icon="user" title="修改角色" summary="在这里你可以修改角色">
        <pvc-bread-crumb-item title="角色" url="/role"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
        <pvc-panel title="#{{$role->id}}" :closeable="true">
            <pvc-form method="post" action=" {{url('/role/'.$role->id)}}" token="{{csrf_token()}}" :validation="true">

                    <pvc-hidden-field slot="hidden" name="角色[id]" value="{{$role->id}}"></pvc-hidden-field>
                    {{method_field('PUT')}}

                    <pvc-textfield name="role[name]" value="{{$role->name}}" label="标识"></pvc-textfield>
                    <pvc-textfield name="role[display_name]" value="{{$role->display_name}}" label="显示名称"></pvc-textfield>
                    <pvc-textfield name="role[description]" value="{{$role->description}}" label="描述"></pvc-textfield>
                    <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="{{url('/role')}}" slot="footer" slot="footer" title="返回列表"></pvc-link-button>
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

