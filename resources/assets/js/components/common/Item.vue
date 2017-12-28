<template>
    <li v-if="visiabled" :label="label" :value="value">
        <slot />
    </li>
</template>

<script>
    import {ItemListMixin} from "./ItemListMixin";

    export default {
        name: "pvc-item",
        mixins: [ItemListMixin],
        props: {
            visiabled: {
                type: Boolean,
                default: false
            },
            label: String,
            value: String
        },
    }
</script>

<style scoped>

</style>