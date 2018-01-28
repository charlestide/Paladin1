<template>
    <el-table-column v-bind="$attrs" :label="label" :prop="prop" :header-align="headAlign"/>
</template>

<script type="text/babel">
    import {ElTableColumn} from "element-ui";

    const types = ['number','string','date','datetime','time'];

    export default {
        name: "pvc-table-column",
        extends: ElTableColumn,
        props: {
            searchable: Boolean,
            prop: String,
            label: String,
            type: [String,Function],
            contentAlign: {
                type: String,
                validator: (value) => _.includes(['left','center','right'],value),
                default: 'left'
            },
            align: {
                type: String,
                validator: (value) => _.includes(['left','center','right'],value),
                default: 'left'
            },
            headerAlign: {
                type: String,
                validator: (value) => _.includes(['left','center','right'],value),
                default: 'left'
            },
        },
        computed: {
            headAlign() {
                return this.headerAlign !== 'left' ? this.headerAlign : this.align;
            }
        },
        methods: {

            parseType(type) {
                if (!_.includes(types,type)) {
                    return 'string';
                } else {
                    return type;
                }
            }
        },
        created() {
            this.$parent.$parent.addColumn({
                name: this.prop,
                label: this.label,
                searchable: this.searchable,
                search: '',
                type: this.parseType(this.type),
                align: this.align !== 'left' ? this.align : this.contentAlign
            });
        }
    }
</script>