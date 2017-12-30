<template>
    <div class="form-group">
        <label class="col-sm-3 control-label">{{label}}
            <span v-if="required" class="asterisk">*</span>
        </label>
        <div class="col-sm-7 input-group">
            <slot/>
            <span>{{desc}}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "pvc-field-hor",
        data() {
            return {
                pvcName: 'field-layout-hor',
                pvcType: 'field-layout'
            }
        },
        computed: {
            required() {
                return this.getParentAttribute('field','required',true);
            },
            label() {
                return this.getParentAttribute('field','label',true);
            },
            desc() {
                return this.getParentAttribute('field','desc',true);
            }
        }
    }
</script>

<style scoped>

</style>