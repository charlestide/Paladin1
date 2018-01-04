<template>
    <li v-if="visiabled" :label="label" :value="value">
        <slot />
    </li>
</template>

<script>
    import {ItemMixin} from "./ItemListMixin";

    export default {
        name: "pvc-item",
        mixins: [ItemMixin],
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