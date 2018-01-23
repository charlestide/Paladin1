<template>
    <el-card :header="'#'+$route.params.id+' 更新权限的信息'">
        <el-form v-model="permission" :rules="rules">
            <el-form-item label="名称" prop="name">
                <el-input v-model="permission.name"/>
            </el-form-item>
            <el-form-item>
                <pvc-button type="primary" @click="onSubmit" icon="fa fa-save" :autofocus="true">保存</pvc-button>
                <pvc-button type="primary" icon="fa fa-list" url="/permission">列表</pvc-button>
            </el-form-item>
        </el-form>
    </el-card>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "pvc-permission-edit",
        data() {
            return {
                p: {},
                rules: {
                    name: [
                        {required: true, message: '请输入权限名', trigger: 'blur'},
                        {min: 3, max: 20, message: '长度在 3 到 20 个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        computed: {
            permission() {
                return this.$store.getters['permission/getById'](this.$route.params.id);
            }

        },
        methods: {
            ...mapActions('permission',['get','save']),
            onSubmit(event) {
                event.preventDefault();
                let self = this;
                this.$refs.form.validate( valid => {
                    if (valid) {
                        self.save(self.permission);
                    }
                });
            }
        },
        mounted() {
            this.get(this.$route.params.id);
        },
        beforeRouteUpdate (to, from, next) {
            this.get(to.params.id);
            next();
        }
    }
</script>

<style scoped>

</style>