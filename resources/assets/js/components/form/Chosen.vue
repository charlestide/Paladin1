<template>
    <pvc-field-layout :layout="layout" :label="label" :required="required">
        <select :data-placeholder="placeholder" :required="required" :name="name" class="chosen-select" :multiple="multiple">
            <option v-if="placeholder"></option>
            <slot/>
        </select>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin,valueMixin} from "./formMixin";

    export default {
        name: "pvc-chosen",
        mixins: [layoutMixin,valueMixin],
        props: {
            multiple: {
                type: Boolean,
                default: false
            },
        },
        mounted: function () {
            let self = this;

            $.ajaxSetup({ cache: true });
            $.getScript('https://cdn.bootcss.com/chosen/1.8.2/chosen.jquery.min.js',function () {
                $.ajaxSetup({cache: false});
            });

            $(function () {
                $('select',self.$el).chosen({
                    '.chosen-select-no-results': {
                        no_results_text: '找不到数据!'
                    },
                }).change(function (event,value) {
                    self.$emit('changed',value.selected);
                })
            })
        }
    }
</script>

<style scoped>
    @import "https://cdn.bootcss.com/chosen/1.8.2/chosen.min.css";
</style>