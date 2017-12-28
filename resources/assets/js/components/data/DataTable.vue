<template>
    <table role="datatable" class="table table-striped table-theme">
        <thead>
        <tr>
            <slot></slot>
        </tr>
        </thead>
        <!--tbody section is required-->
        <tbody></tbody>
    </table>
</template>

<script>

    import RemoteLoader from '../../remoteLoader';

    export default {
        name: "pvc-datatable",
        props: {
            source: {
                type: String,
                required: true
            },
            pageLength: Number,
            ordering: Boolean,
            processing: Boolean,
            autoWidth: Boolean,
            alignment: String

        },
        data() {
            return {
                columns: [],
                datatable: null,
            }
        },
        computed:  {
            dataTableConfig: function() {
                let config = {
                    autoWidth: this.autoWidth ? this.autoWidth : false,
                    serverSide: true,
                    processing: this.processing ? this.processing : true,
                    pageLength: this.pageLength ? this.pageLength : 25,
                    responsive: true,
                    ordering: this.ordering ? this.ordering : true,
                    language: {
                        url: '/js/vendor/datatables/lang/Chinese.json'
                    },
                    ajax: this.source,
                    columns: this.columns,
                    className: '',
                    pageType: 'simple_incremental_bootstrap'
                },self = this;

                config.className += ' ' + this.alignmentValue;


                config.drawCallback = function () {
                    //应用文字水平对齐方式
                    $('td').addClass(self.alignmentValue);
                };

                return config;
            },
            //文字水平对齐方式
            alignmentValue: function () {
                let alignClass = 'text-center';
                switch (this.alignment) {
                    case 'left':
                            alignClass = 'text-left';
                        break;
                    case 'right':
                            alignClass = 'text-right';
                        break;
                    case 'center':
                    default:
                        alignClass = 'text-center';
                }

                return alignClass;
            }
        },

        methods: {
            addColumn: function (columnData) {
                this.columns.push(columnData);
            }
        },

        mounted: function () {
            let self = this;

            RemoteLoader.loadJs('/js/vendor/datatables/datatables.min.js',function () {
                $(function () {
                    self.datatable = $(self.$el).DataTable(self.dataTableConfig);
                })
            });
        }
    }
</script>

<style scoped>
    @import "https://cdn.bootcss.com/datatables/1.10.16/css/dataTables.bootstrap.min.css";
    @import "/js/vendor/datatables/datatables.min.css";

</style>