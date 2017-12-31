@extends('paladin::layouts.lay_admin')

    <!-- START @PAGE CONTENT -->
@section('content')

    <pvc-bread-crumb icon="user" title="修改权限" summary="在这里你可以修改权限">
        <pvc-bread-crumb-item title="权限" url="/permission"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
        <pvc-panel title="#{{$permission->id}}" :closeable="true">
            <pvc-form method="post" action=" {{url('/permission/'.$permission->id)}}" token="{{csrf_token()}}" :validation="true">
                    <pvc-hidden-field slot="hidden" name="权限[id]" value="{{$permission->id}}"></pvc-hidden-field>
                    {{method_field('PUT')}}
                    <pvc-textfield name="permission[name]" value="{{$permission->name}}" label="标识"></pvc-textfield>
                    <pvc-textarea name="permission[description]" value="{{$permission->description}}" label="描述"></pvc-textarea>
                    <pvc-button type="submit" icon="save" slot="footer" title="保存"></pvc-button>
                    <pvc-button action="{{url('/permission')}}" slot="footer" icon="list" title="返回列表"></pvc-button>
            </pvc-form>
        </pvc-panel>

    </div><!-- /.body-content -->
    <!--/ End body content -->


@push('scripts')
<script type="text/javascript" src="/paladin/js/form.js"></script>
@endpush
@stop
<!--/ END PAGE CONTENT -->

