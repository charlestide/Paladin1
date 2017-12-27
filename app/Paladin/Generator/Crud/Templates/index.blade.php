@verbatim
@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
@endverbatim
<section id="page-content">

    <pvc-bread-crumb icon="user" title="{{$displayName}}" summary="{{$displayName}}列表">
        <pvc-bread-crumb-item title="{{$displayName}}" url="/{{$modelName}}"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <pvc-panel>
        @verbatim
        <pvc-link-button slot="head-right" target="_blank" href="<?php echo  "{{url('/$modelName/create')}}" ?>" title="新增" icon="plus-square" class="btn-theme" size="xs"></pvc-link-button>
        @endverbatim
        <pvc-datatable source="/{{$modelName}}?format=json">
            @foreach($fields as $fieldName => $field)
            <pvc-data-column data="{{$fieldName}}" title="{{$field['displayName']}}" default="无数据"></pvc-data-column>
            @endforeach
            <pvc-data-column-action title="操作" width="20%">
                <pvc-button title="修改" action="/{{$modelName}}/{data.id}/edit" icon="edit" ></pvc-button>
                <pvc-button title="详情" action="/{{$modelName}}/{data.id}" icon="eye"></pvc-button>
            </pvc-data-column-action>
        </pvc-datatable>
    </pvc-panel>

@verbatim
    <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

</section><!-- /#page-content -->
@stop
<!--/ END PAGE CONTENT -->
@endverbatim
