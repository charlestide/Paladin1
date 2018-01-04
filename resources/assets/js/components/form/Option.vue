<template>
        <div :class="containerClass">
            <input :type="parentType" :name="parentName" :id="id" :value="value" :checked="isChecked">
            <label :for="id">{{label}}</label>
        </div>
</template>

<script>
    import {ItemMixin} from "../common/ItemListMixin";

    export default {
        name: "pvc-option",
        mixins: [
            ItemMixin
        ],
        props: {
            value: String,
            label: String,
            checked: {
                type: Boolean,
                default: false
            },
        },
        computed: {
            parentName: function () {
                return this.getParentByType('select').name;
            },
            containerClass: function () {
                switch (this.parentType) {
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
                return this.getParentAttribute('select','pvcName',true);
            },
            isChecked() {
                if (this.checked) {
                    return true;
                } else {
                    let parentValue = this.getParentAttribute('select', 'value', true);
                    return parentValue !== null && parentValue === this.value;
                }
            }
        }
    }
</script>

<style scoped>

</style>