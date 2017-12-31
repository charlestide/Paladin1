@extends('paladin::layouts.lay_admin')

    <!-- START @PAGE CONTENT -->
@section('content')

    <pvc-bread-crumb icon="user" title="修改角色" summary="在这里你可以修改角色">
        <pvc-bread-crumb-item title="角色" url="/role"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
        <pvc-panel title="#{{$role->id}}" :closeable="true">
            <pvc-form method="post" action=" {{url('/role/'.$role->id)}}" token="{{csrf_token()}}" :validation="true">
                    <pvc-hidden-field slot="hidden" name="角色[id]" value="{{$role->id}}"></pvc-hidden-field>
                    {{method_field('PUT')}}
                    <pvc-textfield name="role[name]" value="{{$role->name}}" label="标识"></pvc-textfield>
                    <pvc-textfield name="role[display_name]" value="{{$role->display_name}}" label="显示名称"></pvc-textfield>
                    <pvc-textfield name="role[description]" value="{{$role->description}}" label="描述"></pvc-textfield>
                    <pvc-button type="submit" slot="footer" title="保存"></pvc-button>
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

