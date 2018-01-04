<template>
    <th data-class="phone" class="text-center" :data="data" :name="name">{{titleValue}}</th>
</template>

<script>
    export default {
        name: "pvc-data-column",
        props: {
            data: {
                type: String,
                required: true
            },
            name: String,
            title: String,
            default: String,
            width: String
        },
        computed: {
            titleValue: function () {
                return this.title ? this.title : (this.name ? this.name : this.data);
            }
        },
        mounted: function () {

            let column = {
                data: this.data,
                name: this.name,
                title: this.titleValue,
                defaultContent: this.default,
                width: this.width
            };

            this.$parent.addColumn(column);
        }
    }
</script>

<style scoped>

</style>