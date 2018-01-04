@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

    <pvc-bread-crumb icon="user" title="创建角色" summary="角色列表">
        <pvc-bread-crumb-item title="角色" url="/admin"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="创建新角色">
            <pvc-form method="post" action="{{url('/role')}}" token="{{csrf_token()}}" :validation="true">
                <pvc-textfield name="role[name]" label="标识"></pvc-textfield>
                <pvc-textfield name="role[display_name]" label="显示名称"></pvc-textfield>
                <pvc-textfield name="role[description]" label="描述"></pvc-textfield>
                <pvc-button type="submit" icon="save" slot="footer" title="保存"></pvc-button>
                <pvc-button action="{{url('/role')}}" slot="footer" icon="list" title="返回列表"></pvc-button>
            </pvc-form>
        </pvc-panel>

    </div><!-- /.body-content -->
    <!--/ End body content -->


@push('scripts')
<script type="text/javascript" src="/paladin/js/form.js"></script>
@endpush

@stop
<!--/ END PAGE CONTENT -->
