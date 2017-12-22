@extends('layouts.lay_admin')

@component('component.asset',[
    'components' => ['underscore', 'datatables'],
    'modules' => 'table'
])
@endcomponent

<!-- START @PAGE CONTENT -->
@section('content')
<section id="page-content">

    @component('component.header',[
            'summary'   =>  '系统角色',
            'title'     =>'角色',
            'icon'      =>  'users',
            'breadcrumb'=> [
                ['title'    =>  '系统管理', 'url' =>  '#'],
                ['title'    =>  '角色', 'url' =>  '/role'],
            ]
        ])
    @endcomponent

    <!-- Start datatable using ajax -->
    <div class="panel rounded shadow">
        <div class="panel-heading">
            <div class="pull-left">
            </div>
            <div class="pull-right">
                <a class="btn btn-sm" data-placement="top" href="{{url('/role/create')}}">
                    <i class="fa fa-user-plus"></i> <span>创建</span>
                </a>
                <button class="btn btn-sm" data-action="refresh" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Refresh"><i class="fa fa-refresh"></i></button>
                <button class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                <button class="btn btn-sm" data-action="remove" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Remove"><i class="fa fa-times"></i></button>
            </div>
            <div class="clearfix"></div>
        </div><!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Start datatable -->
            <table role="datatable" class="table table-striped table-theme" data-url="{{url('role?format=json')}}">
                <thead>
                <tr>
                    <th data-class="phone" class="text-center" data="id" width="50px">ID</th>
                    <th data-class="phone" class="text-center" data="name">标识</th>
                    <th data-class="phone" class="text-center" data="display_name">角色名</th>
                    <th data-hide="phone,tablet" data="updated_at" width="200px">更新于</th>
                    <th data-hide="phone,tablet" data="action" width="200px" style="min-width: 200px" class="text-center">操作</th>
                </tr>
                </thead>
                <!--tbody section is required-->
                <tbody></tbody>
            </table>
            <!--/ End datatable -->
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
    <!--/ End datatable using ajax -->

    <script type="text/javascript">

        $(function(){
            AdminTable.all();
        });

    </script>


    <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

</section><!-- /#page-content -->
@stop
<!--/ END PAGE CONTENT -->
