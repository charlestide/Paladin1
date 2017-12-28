<template>
    <div class="form-group">
        <label class="col-sm-3 control-label">{{label}}
            <span v-if="required" class="asterisk">*</span>
        </label>
        <div class="col-sm-7 input-group">
            <slot/>
        </div>
    </div>
</template>

<script>
    import {ItemListMixin} from "../common/ItemListMixin";

    export default {
        name: "pvc-field-hor",
        mixins: [ItemListMixin],
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