@verbatim
@extends('paladin::layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
@endverbatim

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
                <pvc-button type="submit" icon="save" title="保存" slot="footer"></pvc-button>
                <pvc-button action="<?php echo "{{url('/$modelName')}}" ?>" slot="footer" title="返回列表"></pvc-button>
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
