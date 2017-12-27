<template>
    <pvc-field-layout v-bind="layoutProps">
            <input
                    class="form-control"
                    :placeholder="placeholder"
                    :name="name"
                    :type="type"
                    :required="required"
                    :value="value"

                    v-bind="validationProps"
            >
            <span v-if="icon" class="input-group-addon"><i class="fa" :class="'fa-' + icon"></i></span>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin,valueMixin,validateMixin,styleMixin} from "./formMixin";


    export default {
        name: "pvc-textfield",
        mixins: [layoutMixin,valueMixin,validateMixin,styleMixin],
        props: {
            size: {
                type: String,
                default: "sm",
                validator: function (value) {
                    return value in {lg:'',sm:'',sx:''};
                }
            },
            type: {
                type: String,
                validator: function (value) {
                    return value in {password:'',text:'',email:''};
                },
                default:'text'
            },
        },
    }
</script>

<style scoped>

</style>