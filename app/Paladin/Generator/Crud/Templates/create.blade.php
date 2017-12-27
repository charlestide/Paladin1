@verbatim
@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
@endverbatim
<section id="page-content">

    <pvc-bread-crumb icon="user" title="创建{{$displayName}}" summary="{{$displayName}}列表">
        <pvc-bread-crumb-item title="{{$displayName}}" url="/{{$modelName}}"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="创建新{{$displayName}}">
            <pvc-form method="post" action="<?php echo  "{{url('/$modelName')}}" ?>" token="@{{csrf_token()}}" :validation="true">
                    @foreach($fields as $fieldName => $field)
                        @if (!$field['primary'] and !in_array($fieldName,['created_at','updated_at']))
                        <pvc-textfield name="{{$modelName}}[{{$fieldName}}]" label="{{$field['displayName']}}"></pvc-textfield>
                        @endif
                    @endforeach
                    <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="<?php echo "{{url('/$modelName')}}" ?>" slot="footer" title="返回列表"></pvc-link-button>
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