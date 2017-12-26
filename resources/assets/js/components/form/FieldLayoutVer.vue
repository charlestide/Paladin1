<template>
    <div class="form-group">
        <label>{{label}}
            <span v-if="required" class="asterisk">*</span>
        </label>
        <slot/>
    </div>
</template>

<script>
    export default {
        name: "pvc-form-top",
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