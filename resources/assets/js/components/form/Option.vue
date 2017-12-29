<template>
        <div :class="containerClass">
            <input :type="parentType" :name="parentName" :id="id" :value="value" :checked="checked">
            <label :for="id">{{label}}</label>
        </div>
</template>

<script>
    export default {
        name: "pvc-option",
        props: {
            name: String,
            value: String,
            label: String,
            checked: {
                type: Boolean,
                default: false
            },
            type: {
                type: String,
                validate(value) {
                    return value in {checkbox:'',radio:''}
                },
                default: 'checkbox'
            },
        },
        computed: {
            parentName: function () {
                return this.$parent.name;
            },
            containerClass: function () {
                switch (this.type) {
                    case 'checkbox':
                        return ['ckbox','ckbox-theme'];
                    case 'radio':
                        return ['rdio','rdio-theme'];
                    default:
                        return '';
                }
            },
            id: function () {
                return this.parentName + Math.random();
            },
            parentType() {
                if (this.type) {
                    return this.type;
                } else {
                    return this.$parent.type;
                }
            }
        }
    }
</script>

<style scoped>

</style>