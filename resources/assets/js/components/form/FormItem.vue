<template>
    <el-form-item v-bind="$attrs">
        <slot/>
        <span class="text-danger" v-for="message in errorMessage">服务端验证错误：<i>{{message}}</i></span>
    </el-form-item>
</template>

<script>

    import Definition from "../../store/definition";

    export default {
        name: "pvc-form-item",
        props: {
            prop: String
        },
        computed: {
            formError() {
                if (_.has(this,'$store.getters.'+ Definition.COMMON_GETTER_REMOTE_FORM_ERROR)) {
                    return this.$store.getters[Definition.COMMON_GETTER_REMOTE_FORM_ERROR];
                }
            },
            errorMessage() {
                if (this.prop && this.formError && _.has(this.formError,this.prop)) {
                    return this.formError[this.prop];
                } else {
                    return {}
                }
            }
        },
        methods: {
            resetFormError() {
                if (_.has(this,'$store.mutations' + Definition.COMMON_MUTATION_RESET_REMOTE_FORM_ERROR)) {
                    return this.$store.commit(Definition.COMMON_MUTATION_RESET_REMOTE_FORM_ERROR);
                }
            }
        },
        mounted() {
            this.resetFormError();
        },
        beforeRouteUpdate() {
            this.resetFormError();
        }
    }
</script>

<style scoped>

</style>