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

    export default {
        name: "pvc-chosen",
        mixins: [layoutMixin,fieldMixin,ListMixin],
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
                    self.$emit('changed',value.selected);
                });

            self.select(self.value);
        },
        methods: {
            select(value) {
                if (value) {
                    let $selected = $('option[value=' + value + ']', this.$el),
                        $all = $('option', this.$el);

                    if ($selected.length) {
                        $all.removeAttr('selected');
                        $selected.attr('selected', true);
                        this.chosen.trigger('chosen:updated');
                    }
                }
            }
        }
    }
</script>

<style scoped>
    @import "https://cdn.bootcss.com/chosen/1.8.2/chosen.min.css";
</style>