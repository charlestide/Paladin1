<template>
    <div class="form-group">
        <div class="input-group no-overflow">
            <slot/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "field-layout-none"
    }
</script>

<style scoped>
    .input-group {
        width:100%;
    }
</style>