<template>
    <pvc-field-hor v-if="layout === 'hor'" >
        <slot/>
    </pvc-field-hor>
    <pvc-field-ver v-else-if="layout === 'ver'">
        <slot/>
    </pvc-field-ver>
    <pvc-field-none v-else-if="layout === 'none'">
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
            PvcFieldNone,
        },
        data() {
            return {
                pvcName: 'field-layout',
                pvcType: 'form-layout'
            }
        },
        props: {
            required: {
                type: Boolean,
                default: false
            },
            layout: {
                type: String,
                default: 'hor',
                validate: function (value) {
                    return value in {hor:'',ver:'',none:''}
                }
            }
        },
    }
</script>

<style scoped>

</style>