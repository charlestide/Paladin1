<template>
    <pvc-field-layout :layout="layout" :label="label" :required="required" :name="name">
        <select :data-placeholder="placeholder" v-bind="this.$props" class="chosen-select" >
            <option v-if="placeholder"></option>
            <slot/>
        </select>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin} from "./formMixin";
    import {fieldMixin} from "./fieldMixin";
    import {ListMixin} from "../common/ItemListMixin";

    require('chosen-js');
    let _ = require('underscore');

    /**
     * A simple checkbox component.
     * @module components/basic/checkbox
     * @param {number} [disabled=false] - Disabled component
     * @param {string[]} model - Required, need two way
     */
    export default {
        name: "pvc-chosen",
        mixins: [layoutMixin,fieldMixin,ListMixin],
        model: {
            props: 'value',
            event: 'change'
        },
        data() {
            return {
                pvcName: 'chosen',
                pvcType: ['select','field'],
                fieldType: 'select',
                chosen: null,
                chosenOption: {
                    '.chosen-select-no-results': {
                        no_results_text: '找不到数据!'
                    },
                }
            }
        },
        props: {
            multiple: {
                type: Boolean,
                default: false
            },
        },
        mounted: function () {
            let self = this;
            self.chosen = $('select',self.$el).chosen(self.chosenOption)
                .change(function (event,value) {
                    // self.$emit('changed',value.selected);
                    self.$emit('change',value.selected);
                    self.$emit('change',value.selected);
                });

            self.select(self.value);
        },
        methods: {
            select(value) {
                if (value) {
                    $('select',this.el).val(value);
                    console.log('select',$('select',this.$el).val());
                }
            }
        }
    }
</script>

<style scoped>
    @import "https://cdn.bootcss.com/chosen/1.8.2/chosen.min.css";
</style>