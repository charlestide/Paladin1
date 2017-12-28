<template>
    <pvc-field-layout :layout="layout" :label="label">
        <span v-if="icon && iconPos==='left'" class="input-group-addon"><i :class="iconClass"></i></span>
        <div class="form-control">{{value}}</div>
        <span v-if="icon && iconPos==='right'" class="input-group-addon"><i :class="iconClass"></i></span>
    </pvc-field-layout>
</template>

<script>
    import {layoutMixin} from "./formMixin";
    import {IconMixin} from "../common/IconMixin";
    import {ItemListMixin} from "../common/ItemListMixin";

    export default {
        name: "pvc-label-field",
        mixins: [layoutMixin,IconMixin,ItemListMixin],
        props: {
            value: String
        }
    }
</script>

<style scoped>

</style>