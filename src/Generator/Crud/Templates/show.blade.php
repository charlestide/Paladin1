@verbatim
@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
@endverbatim

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
                <pvc-button title="返回列表" icon="list" action="<?php echo sprintf('{{url(\'/%s\')}}',$modelName) ?>" slot="footer"></pvc-button>
            </pvc-form>
        </pvc-panel>
    </div><!-- /.body-content -->
    <!--/ End body content -->
@verbatim
@endsection
@push('scripts')
<script type="text/javascript" src="/paladin/js/form.js"></script>
@endpush
<!--/ END PAGE CONTENT -->

@endverbatim

