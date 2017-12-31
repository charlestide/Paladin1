<template>
    <pvc-field-layout :layout="layout" :label="label" :required="required" :name="name" type="radio">
        <slot/>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin} from "./formMixin";
    import {fieldMixin} from "./fieldMixin";

    export default {
        name: "pvc-radio",
        mixins: [layoutMixin,fieldMixin],
        data() {
            return {
                pvcName: 'radio',
                pvcType: ['field','select']
            }
        }
    }
</script>

<style scoped>

</style>