<template>
    <li >
        <a :href="url">{{title}}</a>
        <i class="fa fa-angle-right"></i>
    </li>
</template>

<script>
    export default {
        name: "pvc-bread-crumb-item",
        props: {
            url: String,
            title: String
        }
    }
</script>

<style scoped>

</style>