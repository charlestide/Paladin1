<template>
    <div class="form-group">
        <div class="input-group no-overflow">
            <slot/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "field-layout-none",
        data() {
            return {
                pvcName: 'field-layout-none',
                pvcType: 'field-layout'
            }
        },
    }
</script>

<style scoped>
    .input-group {
        width:100%;
    }
</style>