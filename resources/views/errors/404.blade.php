@extends('layouts.lay_admin')

<!-- START @ERROR PAGE -->
@section('content')

    <!-- Start page header -->
    <div class="header-content">
        <h2><i class="fa fa-ban"></i>Error 404 <span>page not found</span></h2>
        <div class="breadcrumb-wrapper hidden-xs">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="{{url('dashboard')}}">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Pages</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Error 404</li>
            </ol>
        </div>
    </div><!-- /.header-content -->
    <!--/ End page header -->

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <div class="row">
            <div class="col-md-12">

                <!-- START @ERROR PAGE -->
                <div class="error-wrapper">
                    <h1>404!</h1>
                    <h3>您访问的页面找不到</h3>
                    <h4>页面可能已经被 删除 或者 不可用 <br> <br/> 您可以使用左侧的导航来寻找功能</h4>
                </div>
                <!--/ END @ERROR PAGE -->

            </div>
        </div><!-- /.row -->

    </div><!-- /.body-content -->
    <!--/ End body content -->


@stop
<!--/ END ERROR PAGE -->
