@extends('layouts.lay_admin')

<!-- START @PAGE CONTENT -->
@section('content')
<section id="page-content">

    <pvc-bread-crumb icon="user" title="CRUD生成" summary="用于生成某个MODEL的CRUD功能">
        <pvc-bread-crumb-item title="代码生成" url="#"></pvc-bread-crumb-item>
        <pvc-bread-crumb-item title="CRUD生成" url="/generator/crud"></pvc-bread-crumb-item>
    </pvc-bread-crumb>

    <!-- Start body content -->
    <div class="body-content animated fadeIn">

        <pvc-panel title="生成CRUD代码" :closeable="true" :validation="true">
            <pvc-form method="post" action="{{url('/generator/crud/run')}}" token="{{csrf_token()}}" :validation="false">
                <pvc-chosen name="modelClass" label="请选择Model" :required="true" placeholder="请选择一个Model" v-on:changed="modelSelected" >
                    @foreach($models as $model)
                    <option value="{{$model}}">{{$model}}</option>
                    @endforeach
                </pvc-chosen>
                <pvc-textfield name="modelDisplayName" label="Model的显示名称" :required="true" placeholder="请为Model指定一个显示用的名称" :value="modelDisplayName"></pvc-textfield>
                <pvc-checkbox name="overwriteFile" label="是否覆盖文件">
                    <pvc-option value="true"></pvc-option>
                </pvc-checkbox>
                <pvc-form-divider v-show="modelClass" :label="modelClass +' 的字段'"></pvc-form-divider>
                <div v-for="(column,columnName) in modelColumns">
                    <pvc-textfield  :name="'modelColumns['+columnName+'][displayName]'" :value="column.displayName" :label="columnName+' ('+column.type+')'" placeholder="请定义一个显示名称"></pvc-textfield>
                    <pvc-hidden-field  :name="'modelColumns['+columnName+'][type]'" :value="column.type"></pvc-hidden-field>
                </div>
                <button type="submit" class="btn btn-theme" slot="footer">生成</button>
            </pvc-form>
        </pvc-panel>
    </div><!-- /.body-content -->
    <!--/ End body content -->

    <!-- Start footer content -->
    @include('layouts._footer-admin')
    <!--/ End footer content -->

</section><!-- /#page-content -->

@stop
<!--/ END PAGE CONTENT -->
@push('scripts')
    <script type="text/javascript" src="/js/form.js"></script>
    <script type="text/javascript">
        const content = new Vue({
            el: '#page-content',
            data: {
                modelClass: '',
                modelDisplayName: '',
                modelColumns: [],
            },
            watch: {
                modelClass: function (value, oldValue) {
                    let self = this;
                    $.getJSON('{{url('generator/crud/model')}}',{modelClass: value},function (json) {
                        if (json) {
                            self.modelColumns = json.columns;
                            self.modelDisplayName = json.modelDisplayName;
                        }
                    });
                }
            },
            methods: {
                modelSelected: function (modelClass) {
                    this.modelClass = modelClass;
                }
            }
        });

    </script>
@endpush
