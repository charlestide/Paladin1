<template>
    <pvc-field-hor v-if="layout === 'hor'" :label="label" :required="required" :name="name" type="select">
        <select>
            <slot/>
        </select>
    </pvc-field-hor>
    <pvc-field-ver v-else-if="layout === 'ver'" :label="label" :required="required" :name="name" type="select">
        <select>
            <slot/>
        </select>
    </pvc-field-ver>
    <pvc-field-none v-else-if="layout === 'none'" :label="label" :required="required" :name="name" type="select">
        <select>
            <slot/>
        </select>
    </pvc-field-none>
</template>

<script>
    import PvcFieldHor from "./FieldLayoutHor";
    import PvcFieldVer from "./FieldLayoutVer";
    import PvcFieldNone from "./FieldLayoutNone";

    export default {
        name: "pvc-select",
        components: {
            PvcFieldVer,
            PvcFieldHor,
            PvcFieldNone
        },
        props: {
            required: {
                type: Boolean,
                default: false
            },
            label: String,
            name: String,
            value: String,
            layout: {
                type: String,
                default: 'hor',
                validate: function (value) {
                    return value in {hor:'',ver:'',none:''}
                }
            }
        },
        mounted: function () {
            let self = this;

            $.ajaxSetup({ cache: true });
            $.getScript('https://cdn.bootcss.com/select2/4.0.5/js/select2.min.js',function () {
                $.getScript('https://cdn.bootcss.com/select2/4.0.5/js/i18n/zh-CN.js',function () {
                    $.ajaxSetup({cache: false});
                })
            });

            $(function () {
                $('select',self.$el).select2();
            })
        }
    }
</script>

<style scoped>
    @import "https://cdn.bootcss.com/select2/4.0.5/css/select2.min.css";
    @import "https://cdn.bootcss.com/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css";
    @import "https://cdn.bootcss.com/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css";
</style>