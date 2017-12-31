<template>
    <div class="form-group form-group-divider">
        <div class="form-inner">
            <h4 class="no-margin">{{label}}</h4>
        </div>
    </div>
</template>

<script>
    export default {
        name: "pvc-form-divider",
        props: {
            label: String
        }
    }
</script>

<style scoped>

</style>