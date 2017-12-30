<template>
    <pvc-field-layout :layout="layout" :label="label" :required="required" :name="name">
        <slot/>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin} from "./formMixin";
    import {fieldMixin} from "./fieldMixin";

    export default {
        name: "pvc-checkbox",
        mixins: [layoutMixin,fieldMixin],
        data() {
            return {
                pvcName: 'checkbox',
                pvcType: ['field','select']
            }
        },
        props: {
            options: Array,
        }
    }
</script>

<style scoped>

</style>