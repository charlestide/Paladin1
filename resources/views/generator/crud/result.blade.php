@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')

    <pvc-bread-crumb icon="user" title="CRUD生成结果" summary="用于生成某个MODEL的CRUD功能">
        <pvc-bread-crumb-item title="代码生成" url="#"></pvc-bread-crumb-item>
        <pvc-bread-crumb-item title="CRUD生成" url="/generator/crud"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="生成CRUD代码" :closeable="true">
            <pvc-form>
                <pvc-label-field label="Model: " value="{{$modelClass}} : {{$modelDisplayName}}"></pvc-label-field>

                <pvc-form-divider label="{{old('modelClass')}}的字段"></pvc-form-divider>
                @foreach($modelColumns as $columnName => $column)
                    <pvc-label-field label="{{$columnName}}" value="{{$column['displayName']}}"></pvc-label-field>
                @endforeach
                <pvc-form-divider label="生成结果"></pvc-form-divider>
                <br />
                <pre>{{$generatedResult}}</pre>
                <pvc-button title="再生成一个？" action="{{url('generator/crud')}}" icon="gear" slot="footer"></pvc-button>
            </pvc-form>
        </pvc-panel>
    </div><!-- /.body-content -->
    <!--/ End body content -->


@stop
<!--/ END PAGE CONTENT -->
@push('scripts')
    <script type="text/javascript" src="/paladin/js/form.js"></script>
@endpush