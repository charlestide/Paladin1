<template>
    <el-card :header="'#'+$route.params.id+' 更新权限的信息'" >
        <el-form :model="permission" :rules="rules" ref="form">
            <pvc-form-item label="名称" prop="name">
                <el-input v-model="permission.name"/>
            </pvc-form-item>
            <el-form-item label="描述" prop="description">
                <el-input v-model="permission.description" type="textarea"/>
            </el-form-item>
            <el-form-item>
                <pvc-button type="primary" @click="onSubmit" icon="fa fa-save" :autofocus="true">保存</pvc-button>
                <pvc-button type="primary" icon="fa fa-list" url="/permission">列表</pvc-button>
                <pvc-button type="primary" icon="el-icon-arrow-right" :url="'/permission/'+(this.$route.params.id+1)+'/edit'">修改下一个</pvc-button>
            </el-form-item>
        </el-form>
    </el-card>
</template>

<script>
    import {mapActions,mapGetters} from "vuex";
    import Definition from "../../store/definition";

    export default {
        name: "pvc-permission-edit",
        data() {
            return {
                rules: {
                    name: [
                        {required: true, message: '请输入权限名', trigger: 'blur'},
                        {min: 3, max: 20, message: '长度在 3 到 20 个字符', trigger: 'blur'}
                    ]
                },
            }
        },
        computed: {
            ...mapGetters('permission',{permission:Definition.STORE_GETTER_CURRENT})
        },
        methods: {
            ...mapActions('permission',{get:Definition.STORE_ACTION_GET,save:Definition.STORE_ACTION_UPDATE}),
            onSubmit(event) {
                event.preventDefault();
                this.$refs.form.validate(valid => {
                    if (valid) {
                        this.save(this.permission)
                            // .catch(data => {
                            //     this.remoteError = data.errors;
                            // })
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