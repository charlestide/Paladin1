<template>
    <form class="form-horizontal form-bordered validate" role="form" >
        <input v-if="token" type="hidden" name="_token" :value="token" />
        <slot name="hidden" />
        <div class="form-body">
            <slot/>
        </div>
        <div class="form-footer">
            <div class="col-sm-offset-3">
                <slot name="footer" />
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "pvc-form",
        props: {
            token: String,
        }
    }
</script>

<style scoped>

</style>