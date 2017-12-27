<template>
        <div :class="containerClass">
            <input :type="type" :name="parentName" :id="id" :value="value" :checked="checked">
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
            }
        },
        computed: {
            parentName: function () {
                return this.$parent.name;
            },
            type: function () {
                return this.$parent.type;
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
            }
        },
        mounted: function () {
        }
    }
</script>

<style scoped>

</style>