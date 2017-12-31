<template>
    <div class="form-group">
        <label>{{label}}
            <span v-if="required" class="asterisk">*</span>
        </label>
        <div class="input-group">
            <slot/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "pvc-field-ver",
        data() {
            return {
                pvcName: 'field-layout-ver',
                pvcType: 'field-layout'
            }
        },
        props: {
            required: {
                type: Boolean,
                default: false
            },
            label: String,
            name: String,
            value: String
        },
        computed: {
            type: function () {
                return this.$parent.type;
            }
        }
    }
</script>

<style scoped>

</style>