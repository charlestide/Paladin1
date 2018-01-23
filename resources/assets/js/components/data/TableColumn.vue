<template>
    <el-table-column v-bind="$attrs" :label="label" :prop="prop"/>
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
            type: [String,Function]
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
                type: this.parseType(this.type)
            });
        }
    }
</script>