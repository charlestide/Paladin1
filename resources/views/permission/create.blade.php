@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')


    <pvc-bread-crumb icon="user" title="创建权限" summary="权限列表">
        <pvc-bread-crumb-item title="权限" url="/admin"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
        <pvc-panel title="创建新权限">
            <pvc-form method="post" action="{{url('/permission')}}" token="{{csrf_token()}}" :validation="true">
                <pvc-textfield name="permission[name]" label="名称"></pvc-textfield>
                <pvc-select name="permission[policy]" label="策略"></pvc-select>
                <pvc-select name="permission[action]" label="方法"></pvc-select>
                <pvc-textfield name="permission[description]" label="描述"></pvc-textfield>
                <pvc-textfield name="permission[updated_at]" label="更新于"></pvc-textfield>
                <pvc-button type="submit" icon="save" slot="footer" title="保存"></pvc-button>
                <pvc-button action="{{url('/permission')}}" icon="list" slot="footer" title="返回列表"></pvc-button>
            </pvc-form>
        </pvc-panel>

    </div><!-- /.body-content -->
    <!--/ End body content -->

@push('scripts')
<script type="text/javascript" src="/paladin/js/form.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->
