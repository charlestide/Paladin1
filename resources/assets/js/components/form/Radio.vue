<template>
    <pvc-field-layout :layout="layout" :label="label" :required="required" :name="name" type="radio">
        <slot/>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin,valueMixin} from "./formMixin";

    export default {
        name: "pvc-radio",
        mixins: [layoutMixin,valueMixin],
        data() {
            return {
                type: 'radio'
            }
        }
    }
</script>

<style scoped>

</style>