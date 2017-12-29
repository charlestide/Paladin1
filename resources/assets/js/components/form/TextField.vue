<template>
    <pvc-field-layout v-bind="layoutProps">
        <span v-if="this.$slots.left" class="input-group-addon 1">
            <slot name="left"/>
        </span>
        <span v-if="checkbox" class="input-group-addon">
            <div class="ckbox ckbox-theme">
                <input :id="checkboxId" :checked="inputEnabled" type="checkbox" v-on:click.native="handlerChecked" />
                <label :for="checkboxId"></label>
            </div>
        </span>
        <div v-if="selectbox" class="input-group-btn">
            <button type="button" class="btn btn-theme" tabindex="-1">{{value}}</button>
            <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" tabindex="-1" aria-expanded="false">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li v-for="(option,index) in items" @click="handlerSelectOption"  >
                    <a @click="handlerSelectOption" href="javascript:void(0)" :index="index">{{option.label}}</a>
                </li>
                <slot/>
            </ul>
        </div>
        <span v-if="icon && iconpos==='left'" class="input-group-addon 1"><i :class="iconClass"></i></span>
            <input
                class="form-control"
                :placeholder="placeholder"
                :name="name"
                :type="type"
                :required="required"
                :value="textValue"
                :disabled="!inputEnabled"
                v-bind="validationProps"
            >
        <span v-if="icon && iconpos==='right'" class="input-group-addon"><i :class="iconClass"></i></span>
        <span v-if="this.$slots.right" class="input-group-addon">
            <slot name="right"/>
        </span>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin,valueMixin,validateMixin,formMixin} from "./formMixin";
    import {IconMixin} from "../common/IconMixin";
    import {ItemListMixin} from "../common/ItemListMixin";

    export default {
        name: "pvc-textfield",
        mixins: [layoutMixin,valueMixin,validateMixin,IconMixin,formMixin,ItemListMixin],
        data() {
            return {
                textValue: this.value
            }
        },
        props: {
            size: {
                type: String,
                default: "sm",
                validator: function (value) {
                    return value in {lg:'',sm:'',sx:''};
                }
            },
            type: {
                type: String,
                validator: function (value) {
                    return value in {password:'',text:'',email:''};
                },
                default:'text'
            },
            checkbox: {
                type: Boolean,
                default: false
            },
            selectbox: {
                type: [Boolean, Array],
                default: false,
            }
        },
        computed: {
            checkboxId() {
                return Math.random();
            }
        },
        methods: {
            handlerChecked() {
                this.inputEnabled = !this.inputEnabled;
                this.$emit('check',this.inputEnabled);
            },
            handlerSelectOption(event) {
                let index = $(event.target).attr('index');
                this.textValue = this.items[index].value;
            }
        }
    }
</script>

<style scoped>

</style>