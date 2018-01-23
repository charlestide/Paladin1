<template>
    <el-form v-model="role" :rules="rules" ref="form" label-position="top">
        <el-card :header="'#'+role.id+' 更新角色的信息'">
            <el-tabs>
                <el-tab-pane label="基本信息">
                    <el-form-item label="名称" prop="name">
                        <el-input v-model="role.name"/>
                    </el-form-item>
                    <el-form-item label="显示名称" prop="display_name">
                        <el-input v-model="role.display_name"/>
                    </el-form-item>

                </el-tab-pane>
                <el-tab-pane label="分配权限" prop="permission">
                    <el-form-item>
                        <el-transfer filterable v-model="permissionIds" :titles="['可选择','已分配']"
                                     :data="permissions" :props="{key:'id',label:'name'}"/>
                    </el-form-item>
                </el-tab-pane>
            </el-tabs>
            <el-form-item>
                <pvc-button type="primary" @click="onSubmit" icon="fa fa-save" :autofocus="true">保存</pvc-button>
                <pvc-button type="primary" icon="fa fa-list" url="/role">列表</pvc-button>
            </el-form-item>
        </el-card>
    </el-form>
</template>

<script>

    import {mapGetters,mapMutations,mapActions} from "vuex";

    export default {
        name: "pvc-role-create",
        data() {
            return {
                permissionIds:[],
                rules: {
                    name: [
                        {required: true, message: '请输入角色用户名', trigger: 'blur'},
                        {min: 3, max: 30, message: '长度在 3 到 30 个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        computed: {
            ...mapGetters('role',{role: 'empty'}),
            ...mapGetters('permission',{allPermissions:'filtered',permissionQuery:'filteredQuery'}),
            permissions() {
                let self = this;
                _.filter(this.allPermissions,item => {
                    return !_.includes(self.permissionIds,item.id);
                });
                return this.allPermissions;
            }
        },
        methods: {
            ...mapActions('role',['load','create']),
            ...mapActions('permission',{getPermissions: 'getFiltered'}),
            ...mapMutations('permission',{resetPermissions: 'resetFilteredQuery'}),
            onSubmit(event) {
                event.preventDefault();
                let self = this;
                this.$refs.form.validate( valid => {
                    this.role.permissionIds = this.permissionIds;

                    if (valid) {
                        this.create({
                            data:this.role,
                            callback(role) {
                                self.$router.push('/role/'+role.id);
                            }
                        });
                    }
                });
            },
        },
        mounted() {
            this.resetPermissions();
            this.getPermissions();
        }
    }
</script>

<style scoped>

</style>