<template>
    <div :class="['panel',rounded,shadow]">
        <div class="panel-heading">
            <div class="pull-left">
                <h3 v-if="title" class="panel-title">{{title}}</h3>
                <slot name="head-left"/>
            </div>
            <div class="pull-right">
                <slot name="head-right"/>

                <button v-if="refreshable" class="btn btn-sm" data-action="refresh" data-container="body" data-toggle="tooltip" data-placement="top" data-title="刷新"><i class="fa fa-refresh"></i></button>
                <button v-if="collapsible" class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" :data-title="collaped ? '展开' :'收起'" v-on:click="toggleCollape">
                    <i class="fa" :class="collaped ? 'fa-angle-down' : 'fa-angle-up' "></i>
                </button>
                <button v-if="closeable" class="btn btn-sm" data-action="remove" data-container="body" data-toggle="tooltip" data-placement="top" data-title="关闭" v-on:click="close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="clearfix"></div>
        </div><!-- /.panel-heading -->
        <div class="panel-body">
            <slot/>
        </div><!-- /.panel-body -->
        <div v-if="this.$slots.footer" class="panel-footer" style="text-align: center">
            <slot name="footer" />
        </div>
    </div><!-- /.panel -->
</template>

<script>
    export default {
        name: "pvc-panel",
        // data() {
        //     return {
        //         collaped: false
        //     }
        // },
        props: {
            closeable: {
                type: Boolean,
                default: false,
            },
            collapsible: {
                type: Boolean,
                default: true,
            },
            refreshable: {
                type: Boolean,
                default: false
            },
            rounded: {
                type: Boolean,
                default: true
            },
            shadow: {
                type: Boolean,
                default: true
            },
            collaped: {
                type: Boolean,
                default: false
            },
            title: String
        },
        methods: {
            toggleCollape: function () {
                $('div.panel-body', $(this.$el)).slideToggle();
                this.collaped = !this.collaped;
            },
            close: function () {
                $(this.$el).remove();
            }
        }
    }
</script>

<style scoped>

</style>