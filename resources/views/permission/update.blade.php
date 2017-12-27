@extends('layouts.lay_admin')

    <!-- START @PAGE CONTENT -->
@section('content')

<section id="page-content">

    <pvc-bread-crumb icon="user" title="修改权限" summary="在这里你可以修改权限">
        <pvc-bread-crumb-item title="权限" url="/permission"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
        <pvc-panel title="#{{$permission->id}}" :closeable="true">
            <pvc-form method="post" action=" {{url('/permission/'.$permission->id)}}" token="{{csrf_token()}}" :validation="true">

                    <pvc-hidden-field slot="hidden" name="权限[id]" value="{{$permission->id}}"></pvc-hidden-field>
                    {{method_field('PUT')}}

                                                                                                    <pvc-textfield name="permission[name]" value="{{$permission->name}}" label="标识"></pvc-textfield>
                                                                                <pvc-textfield name="permission[description]" value="{{$permission->description}}" label="描述"></pvc-textfield>
                                                                                                                                            <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="{{url('/permission')}}" slot="footer" slot="footer" title="返回列表"></pvc-link-button>
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

