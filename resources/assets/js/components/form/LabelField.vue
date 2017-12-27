<template>
    <pvc-field-layout :layout="layout" :label="label">
            <div class="form-control">{{value}}</div>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin} from "./formMixin";

    export default {
        mixins: [layoutMixin],
        name: "pvc-label-field",
        props: {
            value: String
        }
    }
</script>

<style scoped>

</style>