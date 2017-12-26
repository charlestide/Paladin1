@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
<section id="page-content">

    <pvc-bread-crumb icon="user" title="管理员信息" summary="您可以在这里查看一个管理员的详细信息">
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

        <pvc-panel title="#{{$admin->id}} 管理员：{{$admin->name}}">
            <pvc-form>
                <pvc-label-field label="名称" value="{{$admin->name}}"></pvc-label-field>
                <pvc-label-field label="邮箱" value="{{$admin->email}}"></pvc-label-field>
                <pvc-label-field label="创建于" value="{{$admin->created_at}}"></pvc-label-field>
                <pvc-label-field label="更新于" value="{{$admin->updated_at}}"></pvc-label-field>
                <pvc-link-button title="返回列表" href="{{url('/admin')}}" slot="footer"></pvc-link-button>
            </pvc-form>
        </pvc-panel>

        {{--<div class="row">--}}
            {{--<div class="col-md-6">--}}
                {{--<h4># {{$role->id}} {{$role->display_name}}</h4>--}}
                {{--<p class="text-muted">{{$role->name}}</p>--}}
                {{--<div class="panel rounded shadow">--}}
                    {{--<div class="panel-body">--}}
                        {{--<small>{{$role->description}}</small>--}}
                    {{--</div>--}}
                {{--</div><!-- /.panel -->--}}
            {{--</div>--}}
            {{--<div class="col-md-6"></div>--}}
        {{--</div><!-- /.row -->--}}
    </div><!-- /.body-content -->
    <!--/ End body content -->

    <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

</section><!-- /#page-content -->
<script type="text/javascript" src="/js/form.js"></script>

@stop
<!--/ END PAGE CONTENT -->


