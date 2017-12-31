@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')


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
                <pvc-button title="返回列表" icon="list" action="{{url('/permission')}}" slot="footer"></pvc-button>
            </pvc-form>
        </pvc-panel>
    </div><!-- /.body-content -->
    <!--/ End body content -->

@push('scripts')
<script type="text/javascript" src="/paladin/js/form.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->


