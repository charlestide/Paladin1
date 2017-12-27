<template>
    <pvc-field-layout v-bind="layoutProps">
            <textarea
                    class="form-control"
                    :placeholder="placeholder"
                    :name="name"
                    :required="required"
                    :value="value"

                    :rows="rows"
                    :cols="cols"

                    v-bind="validationProps"
            ><slot/></textarea>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin,valueMixin,validateMixin,styleMixin} from "./formMixin";

    export default {
        name: "pvc-textarea",
        mixins: [layoutMixin,valueMixin,validateMixin,styleMixin],
        props: {
            rows: Number,
            cols: Number
        }
    }
</script>

<style scoped>

</style>