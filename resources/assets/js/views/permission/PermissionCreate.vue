<template>
    <el-card header="创建一个新的权限">
        <el-form :model="permission" :rules="rules" ref="form">
            <el-form-item label="名称" prop="name">
                <el-input v-model="permission.name"/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit" icon="fa fa-save" :autofocus="true">保存</el-button>
                <pvc-button type="primary" url="/permission" icon="fa fa-list">列表</pvc-button>
            </el-form-item>
        </el-form>
    </el-card>
</template>

<script>
    import {mapGetters,mapActions} from "vuex";

    export default {
        name: "pvc-permission-create",
        data() {
            return {
                rules: {
                    name: [
                        {required: true, message: '请输入权限名称', trigger: 'blur'},
                        {min: 3, max: 20, message: '长度在 3 到 20 个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        computed: {
            ...mapGetters('permission',{permission: 'empty'}),
        },
        methods: {
            ...mapActions('permission',['create']),
            onSubmit(event) {
                event.preventDefault();
                let self = this;
                this.$refs.form.validate( valid => {
                    if (valid) {
                        this.create({
                            data:this.permission,
                            callback(permission) {
                                self.$router.push('/permission/'+permission.id);
                            }
                        });
                    }
                });
            },
        }
    }
</script>

<style scoped>

</style>