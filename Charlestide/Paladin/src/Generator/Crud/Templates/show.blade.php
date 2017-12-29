@verbatim
@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
@endverbatim
<section id="page-content">

    <pvc-bread-crumb icon="user" title="{{$displayName}}信息" summary="{{$displayName}}详情">
        <pvc-bread-crumb-item title="{{$displayName}}" url="/{{$modelName}}"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="#<?php echo sprintf('{{$%s->%s}}',$modelName,$primaryKey) ?>">
            <pvc-form>
                @foreach($fields as $fieldName => $field)
                    <pvc-label-field label="{{$field['displayName']}}" value="<?php echo sprintf('{{$%s->%s}}',$modelName,$fieldName) ?>"></pvc-label-field>
                @endforeach
                <pvc-link-button title="返回列表" href="<?php echo sprintf('{{url(\'/%s\')}}',$modelName) ?>" slot="footer"></pvc-link-button>
            </pvc-form>
        </pvc-panel>
    </div><!-- /.body-content -->
    <!--/ End body content -->
@verbatim
    <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

</section><!-- /#page-content -->
<script type="text/javascript" src="/js/form.js"></script>

@stop
<!--/ END PAGE CONTENT -->
@endverbatim

