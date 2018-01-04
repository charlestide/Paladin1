<template>
    <pvc-field-layout>
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
    import {layoutMixin,validateMixin} from "./formMixin";
    import {fieldMixin} from "./fieldMixin";

    export default {
        name: "pvc-textarea",
        mixins: [layoutMixin,fieldMixin,validateMixin],
        data() {
            return {
                pvcName: 'textarea',
                pvcType: 'field'
            }
        },
        props: {
            rows: Number,
            cols: Number
        }
    }
</script>

<style scoped>

</style>