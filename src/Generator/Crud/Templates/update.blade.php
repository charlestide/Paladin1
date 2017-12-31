@verbatim
@extends('paladin::layouts.lay_admin')

    <!-- START @PAGE CONTENT -->
@section('content')
@endverbatim

    <pvc-bread-crumb icon="user" title="修改{{$displayName}}" summary="在这里你可以修改{{$displayName}}">
        <pvc-bread-crumb-item title="{{$displayName}}" url="/{{$modelName}}"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">
        <pvc-panel title="#<?php echo sprintf('{{$%s->%s}}',$modelName,$primaryKey) ?>" :closeable="true">
            <pvc-form method="post" action=" <?php echo sprintf('{{url(\'/%s/\'.$%s->%s)}}',$modelName,$modelName,$primaryKey) ?>" token="@{{csrf_token()}}" :validation="true">

                    <pvc-hidden-field slot="hidden" name="{{$displayName}}[id]" value="<?php echo sprintf('{{$%s->%s}}',$modelName,$primaryKey) ?>"></pvc-hidden-field>
                    @{{method_field('PUT')}}

                    @foreach($fields as $fieldName => $field)
                    @if (!$field['primary'] and !in_array($fieldName,['created_at','updated_at']))
                    <pvc-textfield name="{{$modelName}}[{{$fieldName}}]" value="<?php echo sprintf('{{$%s->%s}}',$modelName,$fieldName)?>" label="{{$field['displayName']}}"></pvc-textfield>
                    @endif
                    @endforeach
                    <button type="submit" class="btn btn-theme" slot="footer">保存</button>
                    <pvc-link-button href="<?php echo sprintf('{{url(\'/%s\')}}',$modelName) ?>" slot="footer" slot="footer" title="返回列表"></pvc-link-button>
            </pvc-form>
        </pvc-panel>

    </div><!-- /.body-content -->
    <!--/ End body content -->
@verbatim

@push('scripts')
<script type="text/javascript" src="/paladin/js/form.js"></script>
@endpush
<!--/ END PAGE CONTENT -->

@stop
@endverbatim

