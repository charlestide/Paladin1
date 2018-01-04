@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

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
                <pvc-button title="返回列表" icon="list" action="{{url('/admin')}}" slot="footer"></pvc-button>
            </pvc-form>
        </pvc-panel>
    </div><!-- /.body-content -->
    <!--/ End body content -->

@push('scripts')
<script type="text/javascript" src="/paladin/js/form.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->


