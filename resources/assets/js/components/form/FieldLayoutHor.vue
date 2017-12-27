<template>
    <div class="form-group">
        <label class="col-sm-3 control-label">{{label}}
            <span v-if="required" class="asterisk">*</span>
        </label>
        <div class="col-sm-7">
            <slot/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "pvc-field-hor",
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