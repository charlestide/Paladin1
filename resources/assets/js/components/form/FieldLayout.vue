<template>
    <pvc-field-hor v-if="layout === 'hor'" :label="label" :required="required" :name="name" type="type">
            <slot/>
    </pvc-field-hor>
    <pvc-field-ver v-else-if="layout === 'ver'" :label="label" :required="required" :name="name" type="type">
            <slot/>
    </pvc-field-ver>
    <pvc-field-none v-else-if="layout === 'none'" :label="label" :required="required" :name="name" type="type">
            <slot/>
    </pvc-field-none>
</template>

<script>

    import PvcFieldHor from "./FieldLayoutHor";
    import PvcFieldVer from "./FieldLayoutVer";
    import PvcFieldNone from "./FieldLayoutNone";

    export default {
        name: "pvc-field-layout",
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
            type:String,
            label: String,
            name: String,
            layout: {
                type: String,
                default: 'hor',
                validate: function (value) {
                    return value in {hor:'',ver:'',none:''}
                }
            }
        }
    }
</script>

<style scoped>

</style>