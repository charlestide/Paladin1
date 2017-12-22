@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
<section id="page-content">

    @component('component.header',[
            'summary'   =>  '系统管理员界面',
            'title'     =>'角色管理',
            'icon'      =>  'users',
            'breadcrumb'=> [
                ['title'    =>  '系统管理', 'url' =>  '#'],
                ['title'    =>  '角色', 'url' =>  '/role'],
            ]
        ])
    @endcomponent

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

        <div class="row">
            <div class="col-md-6">
                <h4># {{$role->id}} {{$role->display_name}}</h4>
                <p class="text-muted">{{$role->name}}</p>
                <div class="panel rounded shadow">
                    <div class="panel-body">
                        <small>{{$role->description}}</small>
                    </div>
                </div><!-- /.panel -->
            </div>
            <div class="col-md-6"></div>
        </div><!-- /.row -->
    </div><!-- /.body-content -->
    <!--/ End body content -->

    <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

</section><!-- /#page-content -->
@stop
<!--/ END PAGE CONTENT -->


