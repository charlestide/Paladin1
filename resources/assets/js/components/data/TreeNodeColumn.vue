<template>
    
</template>

<script>

    let _ = require('underscore');

    export default {
        name: "pvc-tree-node-column",
        props: {
            title: String,
            index: {
                type: Number
            }
        },
        mounted() {
            if (_.has(this.$parent,'addColumn') && _.isFunction(this.$parent.addColumn)) {
                let column = {
                    title: this.title,
                    index: this.index
                };
                this.$parent.addColumn(column);
            }
        }
    }
</script>

<style scoped>

</style>