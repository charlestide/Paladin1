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
            <div class="col-md-12">

                <!-- Start sample validation 1-->
                <div class="panel rounded shadow">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h3 class="panel-title">{!! Request::is('*/create') ? '创建角色' : '修改角色 #'.$role->id.' '!!}</h3>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>
                            <button class="btn btn-sm" data-action="remove" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body no-padding">
                        <form class="form-horizontal form-bordered validate" role="form" method="post" action="{{url('/role')}}" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            @if(!Request::is('*/create'))
                                <input type="hidden" name="role[id]" value="{{$role->id}}">
                            @endif
                            <div class="form-body">
                                <div class="form-group has-feedback">
                                    <label class="col-sm-3 control-label">名称 <span class="asterisk">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control input-sm" name="role[display_name]" required max="3" min="3" value="{!! Request::is('*/create') ? '' : $role->display_name !!}">
                                        <label for="airport[code]"></label>
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">标识 <span class="asterisk">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control input-sm" name="role[name]" required value="{!! Request::is('*/create') ? '' : $role->name !!}">
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">描述 <span class="asterisk">*</span></label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control input-sm" name="role[description]">{!! Request::is('*/create') ? '' : $role->description !!}</textarea>
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">创建于 </label>
                                    <div class="col-sm-7">
                                        {!! Request::is('*/create') ? '未创建' : $role->created_at !!}
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">更新于 </label>
                                    <div class="col-sm-7">
                                        {!! Request::is('*/create') ? '未创建' : $role->updated_at !!}
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.form-body -->
                            <div class="form-footer">
                                <div class="col-sm-offset-3">
                                    <button type="submit" class="btn btn-theme">保存</button>
                                </div>
                            </div><!-- /.form-footer -->
                        </form>

                    </div>
                </div><!-- /.panel -->
                <!--/ End sample validation 1 -->

            </div>
        </div><!-- /.row -->

    </div><!-- /.body-content -->
    <!--/ End body content -->

    <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

</section><!-- /#page-content -->
@stop
<!--/ END PAGE CONTENT -->
