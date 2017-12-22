<template>
    <div v-show="type !== 'hidden'" class="form-group">
        <label v-if="label" class="control-label" :class="{'col-sm-3': labelPosition === 'left'}">{{label}} <span v-if="required" class="asterisk">*</span></label>
        <div :class="['input-group-'+size,{'rounded': round},{'col-sm-7': labelPosition === 'left' && label}]">
            <input
                    :class="['input-'+size]"
                    class="form-control"
                    :placeholder="placeholder"
                    :name="name"
                    :type="type"
            >
            <span v-if="icon" class="input-group-addon"><i class="fa" :class="'fa-' + icon"></i></span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "pvc-input",
        props: {
            placeholder: String,
            name: String,
            icon: String,
            label: String,
            size: {
                type: String,
                default: "sm",
                validator: function (value) {
                    return value in {lg:'',sm:'',sx:''};
                }
            },
            round: {
                type: Boolean,
                default: true
            },
            type: {
                type: String,
                validator: function (value) {
                    return value in {hidden:'',password:'',text:'',email:''};
                },
                default:'text'
            },
            required: {
                type:Boolean,
                default: false
            },
            labelPosition: {
                type: String,
                validator: function (value) {
                    return value in {left:'',top:''};
                },
                default: 'left'
            }
        },
        computed: {
            show: function () {
                return this.type !== 'hidden';
            }
        },
        mounted: function () {
            console.log('type',this.type == 'hidden');
        }
    }
</script>

<style scoped>

</style>