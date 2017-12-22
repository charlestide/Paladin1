<template>
    <div class="form-group">
        <label class="control-label" :class="{'col-sm-3': labelPosition === 'left'}">{{label}} </label>
        <div :class="{'col-sm-7': labelPosition === 'left'}">
            {{value}}
        </div>
    </div><!-- /.form-group -->
</template>

<script>
    export default {
        name: "pvc-label-field",
        props: {
            label: String,
            value: String,
            labelPosition: {
                type: String,
                validator: function (value) {
                    return value in {left:'',top:''};
                },
                default: 'left'
            }
        }
    }
</script>

<style scoped>

</style>