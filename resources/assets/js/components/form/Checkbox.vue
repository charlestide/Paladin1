<template>
    <pvc-field-layout :layout="layout" :label="label" :required="required" :name="name" type="checkbox">
        <slot/>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin,valueMixin} from "./formMixin";

    export default {
        name: "pvc-checkbox",
        mixins: [layoutMixin,valueMixin],
        data() {
            return {
                type: 'checkbox'
            }
        },
        props: {
            options: Array,
        }
    }
</script>

<style scoped>

</style>