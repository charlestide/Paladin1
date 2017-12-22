@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
<section id="page-content">

    @component('component.header',[
            'summary'   =>  '系统权限界面',
            'title'     =>'权限管理',
            'icon'      =>  'users',
            'breadcrumb'=> [
                ['title'    =>  '系统管理', 'url' =>  '#'],
                ['title'    =>  '权限', 'url' =>  '/permission'],
            ]
        ])
    @endcomponent

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <div class="row">
            <div class="col-md-6">
                <h4># {{$permission->id}} {{$permission->display_name}}</h4>
                <p class="text-muted">{{$permission->name}}</p>
                <div class="panel rounded shadow">
                    <div class="panel-body">
                        <small>{{$permission->description}}</small>
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


