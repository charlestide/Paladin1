@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

<section id="page-content">

    <pvc-bread-crumb icon="user" title="权限信息" summary="权限详情">
        <pvc-bread-crumb-item title="权限" url="/permission"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="#{{$permission->id}}">
            <pvc-form>
                                    <pvc-label-field label="ID" value="{{$permission->id}}"></pvc-label-field>
                                    <pvc-label-field label="标识" value="{{$permission->name}}"></pvc-label-field>
                                    <pvc-label-field label="描述" value="{{$permission->description}}"></pvc-label-field>
                                    <pvc-label-field label="创建于" value="{{$permission->created_at}}"></pvc-label-field>
                                    <pvc-label-field label="更新于" value="{{$permission->updated_at}}"></pvc-label-field>
                                <pvc-link-button title="返回列表" href="{{url('/permission')}}" slot="footer"></pvc-link-button>
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


