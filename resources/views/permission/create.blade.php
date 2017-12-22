@extends('layouts.lay_admin')


<!-- START @PAGE CONTENT -->
@section('content')

<section id="page-content">

    <saber-content-header title="权限管理" summary="在此管理系统权限" icon="lock">
        <breadcrumb url="#">系统管理</breadcrumb>
        <breadcrumb url="{{url('permission')}}">系统管理</breadcrumb>
    </saber-content-header>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <!-- Start sample validation 1-->
                <saber-create-panel name="权限" token="{{ csrf_token() }}" action="{{url('/permission')}}" backUrl="{{url('permission')}}">
                    <saber-textfield label="名称" name="permission[display_name]" required ></saber-textfield>
                    <saber-textfield label="标识" name="permission[name]" required  ></saber-textfield>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">对象 <span class="asterisk">*</span></label>
                        <div class="col-sm-7">
                            <select class="form-control" placeholder="请选择一个对象，请在以下权限中选择">
                                @foreach($models as $modelName => $tableName)
                                    <option>{{$modelName}}</option>
                                @endforeach
                            </select>
                            <saber-radio-group name="actions" nolabel="true">
                                <option value="create">创建</option>
                                <option value="edit" checked>修改</option>
                                <option value="show">查看</option>
                                <option value="delete">删除</option>
                            </saber-radio-group>
                        </div>
                    </div>
                    <saber-textarea label="描述" name="permission[description]"  ></saber-textarea>
                </saber-create-panel>

                <!--/ End sample validation 1 -->

            </div>
        </div><!-- /.row -->

    </div><!-- /.body-content -->
    <!--/ End body content -->

    <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

    @include('component.form-saber');
    @include('component.common-saber');
    <script type="text/javascript" src="{{asset('/js/modules/form.saber.js')}}"></script>
</section><!-- /#page-content -->
@stop
<!--/ END PAGE CONTENT -->
